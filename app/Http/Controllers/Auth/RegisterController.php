<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\RegisterRequest;
use App\Repository\Eloquent\BlacklistPasswordRepository;
use App\Repository\Eloquent\UserRepository;

class RegisterController extends Controller
{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function register(RegisterRequest $request)
    {
        if(!$this->userRepository->create($request)){
            return response()->json(['password' => 'Mật khẩu bạn nhập vào chứa thông tin nhạy cảm và không được chấp nhận. Vui lòng chọn một mật khẩu khác.'],422);
        }
        return response()->json(["message" => "Đăng kí thành công !!!"]);
    }
}

