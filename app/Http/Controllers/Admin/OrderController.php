<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Order;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::join('users', 'users.id', '=', 'orders.user_id')
                ->join('payments', 'payments.order_id', '=', 'orders.id')
                ->select('orders.*', 'users.name', 'payments.method', 'payments.file', 'payments.status')
                ->orderBy('orders.id', 'desc')
                ->get();
            return DataTables::of($orders)
                ->addColumn('checkbox', function ($order) {
                    if ($order->status == 'pending') {
                        return '<input type="checkbox" name="id[]" value="' . $order->id . '">';
                    } else {
                        return '<input type="checkbox" name="id[]" value="' . $order->id . '" disabled>';
                    }
                })
                ->addColumn('action', function ($order) {
                    if ($order->status == 'pending') {
                        return '
                    <div role="group">
                    <a href="javascript:;" onclick="handle_confirm(\'Apakah Anda Yakin?\',\'Yakin\',\'Tidak\',\'PATCH\',\'' . route('admin.order.accept', $order->id) . '\');" class="btn btn-sm btn-success"><i class="fa fa-check"></i> Approve</a>
                    <a href="javascript:;" onclick="handle_confirm(\'Apakah Anda Yakin?\',\'Yakin\',\'Tidak\',\'PATCH\',\'' . route('admin.order.reject', $order->id) . '\');" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Reject</a>
                        <a href="javascript:;"
                            onclick="load_detail(\'' . route('admin.order.show', $order->id) . '\')"
                            class="btn btn-sm btn-primary">Detail</a>
                    </div>
                    ';
                    } elseif ($order->status == 'approved') {
                        return ' <a href="javascript:;"
                        onclick="load_detail(\'' . route('admin.order.show', $order->id) . '\')"
                        class="btn btn-sm btn-primary">Detail</a>
                    ';
                    }
                })
                ->addColumn('status', function ($order) {
                    if ($order->status == 'pending') {
                        return '<span class="badge badge-soft-warning text-uppercase">Menunggu</span>';
                    } elseif ($order->status == 'approved') {
                        return '<span class="badge badge-soft-success text-uppercase">Dikonfirmasi</span>';
                    } elseif ($order->status == 'rejected') {
                        return '<span class="badge badge-soft-danger text-uppercase">Ditolak</span>';
                    }
                })
                ->addColumn('proof', function ($order) {
                    if ($order->file) {
                        return '<a href="' . asset('images/payment/' . $order->file) . '" target="_blank" class="btn btn-sm btn-info">Lihat Bukti</a>';
                    } else {
                        return '<span class="badge badge-soft-danger text-uppercase">-</span>';
                    }
                })
                ->addColumn('method', function ($order) {
                    return '<span class="badge badge-soft-info text-uppercase">' . $order->method . '</span>';
                })
                ->addColumn('total', function ($order) {
                    return 'Rp. ' . number_format($order->total, 0, ',', '.');
                })
                ->addColumn('user', function ($order) {
                    return $order->name;
                })
                ->rawColumns(['action', 'status', 'proof', 'method', 'total', 'user', 'checkbox'])
                ->make(true);
        }
        return view('pages.admin.orders.main');
    }

    public function show(Order $order)
    {
        return view('pages.admin.orders.show', compact('order'));
    }

    public function export()
    {
        $dates = Order::selectRaw('MONTH(created_at) as month, YEAR(created_at) as year')
            ->groupBy('month', 'year')
            ->get();
        $dates = $dates->map(function ($date) {
            return $date->month . '-' . $date->year;
        });
        return view('pages.admin.orders.export', compact('dates'));
    }

    public function accept(Order $order)
    {
        $notification = new Notification;
        $notification->user_id = $order->user_id;
        $notification->message = 'Pesanan anda dengan kode ' . $order->code . ' Diterima!';
        $notification->type = 'success';
        $notification->save();

        $orderDetails = $order->orderDetails;

        foreach ($orderDetails as $detail) {
            $ticket = Ticket::find($detail->ticket_id);
            $ticket->stock = $ticket->stock - $detail->quantity;
            $ticket->update();
        }

        $payment = $order->payment;
        $payment->status = 'approved';
        $payment->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Pesanan berhasil Diterima',
        ]);
    }

    public function reject(Order $order)
    {
        $notification = new Notification;
        $notification->user_id = $order->user_id;
        $notification->message = 'Pesanan anda dengan kode ' . $order->code . ' Ditolak!';
        $notification->type = 'warning';
        $notification->save();

        $payment = $order->payment;
        $payment->status = 'rejected';
        $payment->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Pesanan berhasil ditolak',
        ]);
    }

    public function acceptAll(Request $request)
    {
        foreach ($request->id as $id) {
            $order = Order::find($id);
            $notification = new Notification;
            $notification->user_id = $order->user_id;
            $notification->message = 'Pesanan anda dengan kode ' . $order->code . ' Diterima!';
            $notification->type = 'success';
            $notification->save();

            $orderDetails = $order->orderDetails;

            foreach ($orderDetails as $detail) {
                $ticket = Ticket::find($detail->ticket_id);
                $ticket->stock = $ticket->stock - $detail->quantity;
                $ticket->update();
            }

            $payment = $order->payment;
            $payment->status = 'approved';
            $payment->save();
        }
        return response()->json([
            'alert' => 'success',
            'message' => 'Pemesanan berhasil Dikonfirmasi',
        ]);
    }

    public function rejectAll(Request $request)
    {
        foreach ($request->id as $id) {
            $order = Order::find($id);
            $notification = new Notification;
            $notification->user_id = $order->user_id;
            $notification->message = 'Pesanan anda dengan kode ' . $order->code . ' Ditolak!';
            $notification->type = 'warning';
            $notification->save();

            $payment = $order->payment;
            $payment->status = 'rejected';
            $payment->save();
        }
        return response()->json([
            'alert' => 'success',
            'message' => 'Pemenanan berhasil Ditolak',
        ]);
    }

    public function pdf(Request $request)
    {
        $month = explode('-', $request->date)[0];
        $year = explode('-', $request->date)[1];
        $orders = Order::whereMonth('created_at', $month)
            ->whereYear('created_at', $year)
            ->get();
        $date = Carbon::createFromDate($year, $month, 1)->translatedFormat('F Y');
        $pdf = PDF::loadView('pages.admin.orders.pdf', ['orders' => $orders, 'date' => $date]);
        return $pdf->download('laporan-pesanan.pdf');
        // return $pdf->stream('laporan-pesanan.pdf');
    }
}
