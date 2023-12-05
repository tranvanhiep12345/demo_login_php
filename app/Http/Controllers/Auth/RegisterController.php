<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\BlacklistPassword;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }
    public function store(RegisterRequest $request)
    {
        $blacklistPasswords = BlacklistPassword::pluck('blacklist_password')->toArray();

        if (in_array($request->password, $blacklistPasswords)) {
            return redirect()->back()
                ->withErrors(['password' => 'Mật khẩu bạn nhập vào chứa thông tin nhạy cảm và không được chấp nhận. Vui lòng chọn một mật khẩu khác.']);
        }
        User::create([
            'display_name'=>$request->display_name,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);
        return redirect()->route('login')
            ->withSuccess('Đăng kí thành công !!!');
    }
}

