<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Repository\Eloquent\BlacklistPasswordRepository;
use App\Repository\Eloquent\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function register(RegisterRequest $request)
    {
        $this->userRepository->create($request);
        return response()->json(["message" => "Đăng kí thành công !!!"]);
    }
}
