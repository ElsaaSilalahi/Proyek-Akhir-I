<?php

namespace App\Http\Controllers\Web;

use PDF;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $orders = Order::where('user_id', auth()->user()->id)->latest()->get();

            return DataTables::of($orders)
                ->addColumn('action', function ($order) {
                    return '
                    <div role="group">

                        <a href="javascript:;"
                            onclick="load_detail(\'' . route('web.order.show', $order->id) . '\')"
                            class="btn btn-sm btn-primary">Detail</a>
                        <a href="' . route('web.order.pdf', $order->id) . '"
                            class="btn btn-sm btn-info me-2" target="_blank"
                            class="menu-link px-3">Cetak</a>
                    </div>
                ';
                })
                ->addColumn('status', function ($order) {
                    if ($order->payment->status == 'pending') {
                        return '<span class="badge badge-soft-warning text-uppercase">Menunggu</span>';
                    } elseif ($order->payment->status == 'approved') {
                        return '<span class="badge badge-soft-success text-uppercase">Dikonfirmasi</span>';
                    } elseif ($order->payment->status == 'rejected') {
                        return '<span class="badge badge-soft-danger text-uppercase">Ditolak</span>';
                    }
                })
                ->addColumn('proof', function ($order) {
                    if ($order->payment->file) {
                        return '<a href="' . asset('images/payment/' . $order->payment->file) . '" target="_blank" class="btn btn-sm btn-info">Lihat Bukti</a>';
                    } else {
                        return '<span class="badge badge-soft-danger text-uppercase">-</span>';
                    }
                })
                ->addColumn('method', function ($order) {
                    return '<span class="badge badge-soft-info text-uppercase">' . $order->payment->method . '</span>';
                })
                ->addColumn('total', function ($order) {
                    return 'Rp. ' . number_format($order->total, 0, ',', '.');
                })
                ->rawColumns(['action', 'status', 'proof', 'method', 'total'])
                ->make(true);
        }
        return view('pages.web.orders.main');
    }

    public function show(Order $order)
    {
        return view('pages.web.orders.show', compact('order'));
    }

    public function pdf(Order $order)
    {
        $qrcode = base64_encode(QrCode::size(100)->generate($order->code));
        $pdf = PDF::loadView('pages.web.orders.pdf', compact('order', 'qrcode'));
        // return $pdf->stream('invoice.pdf');
        return $pdf->download($order->code . '-' . $order->created_at->format('d-m-Y') . '.pdf');
    }
}
