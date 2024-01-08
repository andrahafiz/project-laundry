<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\Console\Input\Input;

class AuthController extends Controller
{
    //
    public function login_admin()
    {
        # code...
        if (Auth::check()) {

            if (auth()->user()->roles === 'ADMIN') {
                return redirect('admin/dashboard');
            }
            return redirect('customer/dashboard');
        } else {
            return view('pages.auth-login');
        }
    }

    public function actionlogin(Request $request)
    {
        $data = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        if (Auth::Attempt(['username' => $data['username'], 'password' => $data['password'], 'active' => 1])) {
            if (auth()->user()->roles === 'ADMIN') {
                return redirect()->intended('admin/produk');
            } elseif (auth()->user()->roles === 'CUSTOMER') {
                return redirect()->intended('customer/produk');
            } else {
                return back()->withErrors([
                    'error' => 'Role tidak ditemukan',
                ])->withInput($request->only('username'));
            }
        } else {
            return back()->withErrors([
                'error' => 'Username atau passowrd tidak ditemukan',
            ])->withInput($request->only('username'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('/');
    }
}
