<?php

namespace App\Http\Controllers\Web;

use PDF;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Ticket;
use App\Helpers\Helper;
use App\Models\Payment;
use App\Models\OrderDetail;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        return view('pages.web.checkout.main', compact('carts'));
    }

    public function check(Request $request)
    {
        $messages = [
            'fullname.required' => 'Nama lengkap harus diisi.',
            'fullname.regex' => 'Nama lengkap harus berupa huruf.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'phone.required' => 'Nomor telepon harus diisi.',
            'phone.unique' => 'Nomor telepon sudah digunakan.',
            'payment.required' => 'Metode pembayaran harus diisi.',
            'image.required' => 'Gambar harus diisi.',
            'image.image' => 'Gambar harus berupa gambar.',
            'image.mimes' => 'Gambar harus berupa jpg, jpeg, png, bmp.',
            'image.max' => 'Gambar tidak boleh lebih dari 2MB.',
            'description.required' => 'Deskripsi harus diisi.',
        ];

        if ($request->payment == 'Bank Transfer') {
            $validators = Validator::make($request->all(), [
                'fullname' => 'required|regex:/^[a-zA-Z ]+$/',
                'email' => 'required|email|unique:users,email, ' . Auth::user()->id,
                'phone' => 'required|numeric|unique:users,phone,' . Auth::user()->id,
                'payment' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'description' => 'required',
            ], $messages);
        } elseif ($request->payment == 'Cash') {
            $validators = Validator::make($request->all(), [
                'fullname' => 'required|regex:/^[a-zA-Z ]+$/',
                'email' => 'required|email',
                'phone' => 'required|numeric',
            ], $messages);
        }
        if ($validators->fails()) {
            $errors = $validators->errors();
            if ($errors->has('fullname')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('fullname'),
                ]);
            } elseif ($errors->has('email')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('email'),
                ]);
            } elseif ($errors->has('phone')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('phone'),
                ]);
            } elseif ($errors->has('payment')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('payment'),
                ]);
            } elseif ($errors->has('image')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('image'),
                ]);
            } elseif ($errors->has('description')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('description'),
                ]);
            }
        }

        return response()->json([
            'alert' => 'success',
        ]);
    }

    public function checkout(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->fullname = $request->fullname;
        $user->name = explode(' ', $request->fullname)[0];
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();


        $cart = Cart::where('user_id', Auth::user()->id)->get();
        $total = 0;

        foreach ($cart as $c) {
            $total += $c->ticket->price * $c->quantity;
        }
        if ($request->payment != 'Cash') {
            $order = new Order;
            $order->code = Helper::IDGenerator();
            $order->user_id = Auth::user()->id;
            $order->total = $total;
            $order->save();
            $payment = new Payment;
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/payment'), $filename);
            $payment->file = $filename;
            $payment->description = $request->description;
            $payment->order_id = $order->id;
            $payment->method = "Bank Transfer";
            $payment->save();
            $cart = Cart::where('user_id', Auth::user()->id)->get();
            foreach ($cart as $c) {
                $order_detail = new OrderDetail;
                $order_detail->order_id = $order->id;
                $order_detail->ticket_id = $c->ticket_id;
                $order_detail->quantity = $c->quantity;
                $order_detail->save();
                $ticket = Ticket::find($c->ticket_id);
                $ticket->stock -= $c->quantity;
                $ticket->update();
            }
        } else {
            $order = new Order();
            $order->code = Helper::IDGenerator();
            $order->user_id = Auth::user()->id;
            $order->total = $total;
            $order->save();
            $payment = new Payment;
            $payment->order_id = $order->id;
            $payment->method = "Cash";
            $payment->save();
            $cart = Cart::where('user_id', Auth::user()->id)->get();
            foreach ($cart as $c) {
                $order_detail = new OrderDetail;
                $order_detail->order_id = $order->id;
                $order_detail->ticket_id = $c->ticket_id;
                $order_detail->quantity = $c->quantity;
                $order_detail->save();
            }
        }
        $notification = new Notification;
        $notification->user_id = 1;
        $notification->message = 'Anda mendapatkan Pesanan!, Kode ' . $order->code;
        $notification->type = 'success';
        $notification->save();
        Cart::where('user_id', Auth::user()->id)->delete();

        return view('pages.web.checkout.detail', ['order' => $order]);
    }

    public function pdf(Order $order)
    {
        $qrcode = base64_encode(QrCode::size(100)->generate($order->code));
        $pdf = PDF::loadView('pages.web.checkout.pdf', compact('order', 'qrcode'));
        // return $pdf->stream('invoice.pdf');
        return $pdf->download($order->code . '-' . $order->created_at->format('d-m-Y') . '.pdf');
    }
}
