<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Repository\Eloquent\UserRepository;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth:api', ['except' => [
            'login'
        ]]);
        $this->userRepository = $userRepository;
    }
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('username', 'password');
        if (!$token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Đăng xuất thành công !!! ']);
    }

    public function changePassword(ChangePasswordRequest $passwordData)
    {
        if (!$this->userRepository->changePassword($passwordData)) {
            return response()->json(['error' => 'Mật khẩu cũ không chính xác.'], 422);
        }
        $user = auth('api')->user();
        $token = JWTAuth::fromUser($user);
        auth('api')->logout();
        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
