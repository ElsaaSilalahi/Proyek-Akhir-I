<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:web')->except('do_logout');
    }
    public function index()
    {
        return view('pages.auth.main');
    }
    public function do_login(Request $request)
    {
        $messages = [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
        ];
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], $messages);
        if ($validator->fails()) {
            $errors = $validator->errors();
            if ($errors->has('email')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('email'),
                ]);
            } else {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('password'),
                ]);
            }
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->role->id == 1) {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                    return response()->json([
                        'alert' => 'success',
                        'message' => 'Welcome back ' . Auth::user()->name,
                        'redirect' => route('admin.dashboard'),
                    ]);
                } else {
                    return response()->json([
                        'alert' => 'error',
                        'message' => 'Maaf, password anda salah.',
                    ]);
                }
            } else {
                if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                    return response()->json([
                        'alert' => 'success',
                        'message' => 'Welcome back ' . Auth::user()->name,
                        'redirect' => route('web.dashboard'),
                    ]);
                } else {
                    return response()->json([
                        'alert' => 'error',
                        'message' => 'Maaf, password anda salah.',
                    ]);
                }
            }
        } else {
            return response()->json([
                'alert' => 'error',
                'message' => 'Maaf, Akun belum terdaftar.',
            ]);
        }
    }
    public function do_register(Request $request)
    {
        $messages = [
            'name.required' => 'Nama harus diisi',
            'name.regex' => 'Nama harus berupa huruf',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
            'password.confirmed' => 'Password tidak sama',
        ];
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|regex:/^[a-zA-Z ]+$/|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric|digits_between:10,13|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ], $messages);

        if ($validator->fails()) {
            $errors = $validator->errors();
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
            } elseif ($errors->has('password')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('password'),
                ]);
            } elseif ($errors->has('password_confirmation')) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $errors->first('password_confirmation'),
                ]);
            }
        }

        $user = new User;
        $user->fullname = $request->fullname;
        $user->name = explode(' ', $request->fullname)[0];
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->role_id = 2;
        $user->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Registrasi Berhasil',
        ]);
    }
    public function do_logout()
    {
        $user = Auth::user();
        Auth::logout($user);
        return redirect('/');
    }
}
