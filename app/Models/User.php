<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\City;
use App\Models\Role;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\Province;
use App\Models\Subdistrict;
use App\Models\Notification;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
