<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Notification;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function counter()
    {
        $total = Notification::where('user_id', 1)->where('read', 0)->count();
        return response()->json([
            'total' => $total,
        ]);
    }

    public function index()
    {
        $user = User::find(Auth::id());
        $notifications = Notification::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        $output = '';

        if ($notifications->count() > 0) {
            foreach ($notifications as $notification) {
                $code = explode(' ', $notification->message);
                $order = Order::where('code', $code[4])->first();
                $output .= '
                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                        <div class="d-flex">
                            <div class="avatar-xs me-3">
                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-16">
                                    <i class="bx bx-badge-check"></i>
                                </span>
                            </div>
                            <div class="flex-1">
                                <a href="javascript:;" onclick="load_detail(\'' . route('admin.order.show', $order->id) . '\')" class="stretched-link">
                                    <h6 class="mt-0 mb-2 lh-base">' . $notification->message . '</h6>
                                    </h6>
                                </a>
                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                    <span><i class="mdi mdi-clock-outline"></i> ' . $notification->created_at->diffForHumans() . '</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    ';
            }
        } else {
            $output .= '
            <div class="w-25 w-sm-50 pt-3 mx-auto">
                <img src="assets/images/svg/bell.svg" class="img-fluid" alt="user-pic">
            </div>
            <div class="text-center pb-5 mt-2">
                <h6 class="fs-18 fw-semibold lh-base">Anda tidak memiliki notifikasi</h6>
            </div>
            ';
        }

        $notifications->each(function ($notification) {
            $notification->read = true;
            $notification->save();
        });

        return response()->json([
            'notifications' => $output,
        ]);
    }
}
