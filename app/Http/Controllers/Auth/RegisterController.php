<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Repository\Eloquent\BlacklistPasswordRepository;
use App\Repository\Eloquent\UserRepository;
use function MongoDB\BSON\toJSON;

class RegisterController extends Controller
{
    public function __construct(UserRepository $userRepository,
                                BlacklistPasswordRepository $blacklistPassword)
    {
        $this->userRepository = $userRepository;
        $this->blacklistPassword = $blacklistPassword;
    }
    public function register(RegisterRequest $request)
    {
        $blacklistPasswords = $this->blacklistPassword->all()->toArray();
        if (in_array($request->password, $blacklistPasswords)) {
            return redirect()->back()
                ->withErrors(['password' => 'Mật khẩu bạn nhập vào chứa thông tin nhạy cảm và không được chấp nhận. Vui lòng chọn một mật khẩu khác.']);
        }
        $this->userRepository->create($request);
        return response()->json(["message" => "Đăng kí thành công !!!"]);
    }
}

