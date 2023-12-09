<?php

namespace App\Http\Controllers\Web;;

use App\Models\Cart;
use App\Models\Province;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function notif()
    {
        $total = 0;
        $output = '';
        $cart = Cart::where('user_id', Auth::guard('web')->user()->id)->get();
        if ($cart->count() > 0) {
            $total = 0;
            foreach ($cart as $c) {
                $output .=
                    '<div class="d-block dropdown-item dropdown-item-cart text-wrap px-3 py-2">
                    <div class="d-flex align-items-center">
                        <img src="' . asset('images/tickets/' . $c->ticket->cover) . '" class="me-3 rounded-circle avatar-sm p-2 bg-light" alt="user-pic">
                        <div class="flex-1">
                            <h6 class="mt-0 mb-1 fs-14">
                                <a href="javascript" class="text-reset">' . $c->ticket->category->name . '</a>
                            </h6>
                            <p class="mb-0 fs-12 text-muted text-nowrap">
                                Quantity: <span>' . $c->quantity . ' x Rp.' . number_format($c->ticket->price, 2, '.', ',') . '</span>
                            </p>
                        </div>
                        <div class="px-2">
                            <h5 class="m-0 fw-normal text-nowrap">Rp. <span class="cart-item-price">' . number_format($c->ticket->price * $c->quantity, 2, '.', ',') . '</span></h5>
                        </div>
                        <div class="ps-2">
                            <a href="javascript:;" onclick="remove_cart(\'Apakah Anda Yakin?\' , \'Yakin\',\'Tidak\' , \'DELETE\' , \'' . route('web.cart.delete', $c->id) . '\');" class="btn btn-icon btn-sm btn-ghost-secondary remove-item-btn"><i class="ri-close-fill fs-16"></i></a>
                        </div>
                    </div>
                </div>';
                $total += $c->ticket->price * $c->quantity;
            }
        } else {
            $output .=
                '<div class="text-center empty-cart" id="empty-cart" style="display: none;">
                <div class="avatar-md mx-auto my-3">
                    <div class="avatar-title bg-soft-info text-info fs-36 rounded-circle">
                        <i class="bx bx-cart"></i>
                    </div>
                </div>
                <h5 class="mb-3">Tiket Anda Kosong!</h5>
                <a href="#" class="btn btn-primary w-md mb-3">Shop Now</a>
            </div>';
        }
        return response()->json([
            'collection' => $output,
            'total' => number_format($total, 2, '.', ','),
            'total_item' => $cart->count(),
        ]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $carts = Cart::where('user_id', Auth::guard('web')->user()->id)->get();
            return view('pages.web.cart.list', compact('carts'));
        }
        return view('pages.web.cart.main');
    }

    public function store(Request $request)
    {
        $cart = Cart::where('user_id', Auth::user()->id)->where('ticket_id', $request->ticket_id)->first();
        $ticket = Ticket::find($request->ticket_id);

        if ($ticket->stock < $request->quantity) {
            return response()->json([
                'alert' => 'error',
                'message' => 'Stok tidak cukup!',
            ]);
        }
        if ($cart) {
            $cart->quantity += $request->quantity;
            $cart->save();
        } else {
            $cart = new Cart();
            $cart->user_id = Auth::user()->id;
            $cart->ticket_id = $request->ticket_id;
            $cart->quantity = $request->quantity;
            $cart->save();
        }

        return response()->json([
            'alert' => 'success',
            'message' => 'Berhasil menambahkan ke tiket anda',
        ]);
    }

    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'quantity' => 'required',
        ]);
        if ($cart->quantity < $cart->ticket->stock) {
            $cart->quantity = $request->quantity;
            $cart->save();
            return response()->json([
                'quantity' => $cart->quantity,
                'subtotal' => number_format($request->quantity * $cart->ticket->price),
                'alert' => 'success',
                'message' => 'Berhasil mengubah jumlah',
            ]);
        } else {
            return response()->json([
                'quantity' => $cart->quantity,
                'subtotal' => number_format($cart->quantity * $cart->ticket->price),
                'alert' => 'error',
                'message' => 'Stok tidak cukup!',
            ]);
        }
    }

    public function increase(Cart $cart)
    {
        if ($cart->quantity < $cart->ticket->stock) {
            $cart->quantity = $cart->quantity + 1;
            $cart->update();
            return response()->json([
                'alert' => 'success',
                'message' => 'Berhasil menambahkan stok',
                'quantity' => $cart->quantity,
                'subtotal' => number_format($cart->quantity * $cart->ticket->price),
            ]);
        } else {
            return response()->json([
                'alert' => 'error',
                'message' => 'Stok tidak mencukupi',
                'quantity' => $cart->quantity,
                'subtotal' => number_format($cart->quantity * $cart->ticket->price),
            ]);
        }
    }

    public function decrease(Cart $cart)
    {
        if ($cart->quantity > 1) {
            $cart->quantity = $cart->quantity - 1;
            $cart->update();
            return response()->json([
                'alert' => 'success',
                'message' => 'Berhasil mengurangi jumlah pesanan',
                'quantity' => $cart->quantity,
                'subtotal' => number_format($cart->quantity * $cart->ticket->price),
            ]);
        } else {
            return response()->json([
                'alert' => 'error',
                'message' => 'Stok tidak boleh kurang dari 1',
                'quantity' => $cart->quantity,
                'subtotal' => number_format($cart->quantity * $cart->ticket->price),
            ]);
        }
    }
    public function destroy(Cart $cart)
    {
        $cart->delete();
        $count = Cart::where('user_id', Auth::guard('web')->user()->id)->count();
        return response()->json([
            'alert' => 'success',
            'total_item' => $count,
            'message' => 'Berhasil menghapus dari keranjang',
        ]);
    }
}
