<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users  = User::where('role_id', 2)->get();
            return DataTables::of($users)
                ->addColumn('action', function ($user) {
                    return '<ul class="list-inline hstack gap-2 mb-0">
                    <li class="list-inline-item edit" data-bs-toggle="tooltip" data-bs-trigger="hover"
                        data-bs-placement="top" title="" data-bs-original-title="Edit">
                        <a href="javascript:;"
                            onclick="load_detail(\'' . route('admin.users.show', $user->id) . '\')"
                            class="text-primary d-inline-block edit-item-btn">
                            <i class="ri-eye-fill fs-16"></i>
                        </a>
                    <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                        data-bs-placement="top" title="" data-bs-original-title="Remove">
                        <a href="javascript:;"
                            onclick="handle_confirm(\'Apakah Anda Yakin?\',\'Yakin\',\'Tidak\',\'DELETE\',\'' . route('admin.users.destroy', $user->id) . '\');"
                            class="text-danger d-inline-block remove-item-btn">
                            <i class="ri-delete-bin-5-fill fs-16"></i>
                        </a>
                    </li>
                </ul>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('pages.admin.user.main');
    }

    public function show(User $user)
    {
        return view('pages.admin.user.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(
            [
                'alert' => 'success',
                'message' => 'User deleted successfully!'
            ]
        );
    }
}
