<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\SensitivePassword;
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
        $sensitivePasswords = SensitivePassword::pluck('sensitive_password')->toArray();
        $inputPassword = $request->password;

        foreach ($sensitivePasswords as $password) {
            if (Str::startsWith($inputPassword, $password)) {
                return redirect()->route('register')
                    ->withErrors(['password' => 'Mật khẩu bạn nhập vào chứa thông tin nhạy cảm và không được chấp nhận. Vui lòng chọn một mật khẩu khác.']);
            }
        }
        User::create([
            'display_name'=>$request->display_name,
            'username'=>$request->username,
            'password'=>Hash::make($request->password)
        ]);
        return redirect()->route('login')
            ->withSuccess('You have successfully registered');
    }
}

