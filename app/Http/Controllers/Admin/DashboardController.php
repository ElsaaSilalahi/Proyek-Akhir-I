<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::join('roles', 'roles.id', '=', 'users.role_id')
            ->where('roles.name', '!=', 'Administrator')
            ->select('users.*', 'roles.name as role_name')
            ->orderBy('users.id', 'desc')
            ->get();
        $total_user = $users->count();
        $total_order = Payment::count();
        return view('pages.admin.dashboard.main', compact('total_user', 'total_order', 'users'));
    }
}
