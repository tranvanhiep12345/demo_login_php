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
            'logout', 'dashboard'
        ]);
    }
    public function login()
    {
        return view('login');
    }
    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');
        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->route('dashboard')
                ->withSuccess('Logged in!');
        }
        return back()->withErrors([
            'username' => 'Username does not exsist',
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
                'username' => 'Please login to access',
            ])->onlyInput('username');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out ');
    }
}
