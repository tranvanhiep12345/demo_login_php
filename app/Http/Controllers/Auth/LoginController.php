<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard','home','role'
        ]);
    }
    public function login()
    {
        return view('auth.login');
    }
    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');
        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('dashboard')
                ->withSuccess('Đăng nhập thành công !!!');
        }
        return back()->withErrors([
            'username' => 'Tài khoản hoặc mật khẩu không đúng',
        ])->onlyInput('username');
    }
    public function dashboard()
    {
        if(Auth::check())
        {
            return view('dashboard');
        }

        return redirect()->route('login')
            ->withErrors([
                'username' => 'Vui lòng đăng nhập',
            ])->onlyInput('username');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('Đăng xuất thành công !!! ');
    }
}
