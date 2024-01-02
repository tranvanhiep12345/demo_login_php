<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Repository\Eloquent\UserRepository;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    protected $userRepository;

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
        if (!auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Tên đăng nhập hoặc mật khẩu không đúng'], 422);
        }

        if ($this->userRepository->checkUserBlock($request['username'])) {
            return response()->json(['error' => 'Tài khoản của bạn hiện đang tạm khóa'], 401);
        }

        $userFind = $this->userRepository->cacheUserData($request->username);
        $customPayload = [
            'jwt_version' => $userFind->jwt_version
        ];
        $credentials = $request->only('username', 'password');
        $token = auth('api')->claims($customPayload)->attempt($credentials);
        return $this->respondWithToken($token);
    }

    public function logout()
    {
        $user = auth('api')->user();
        $this->userRepository->clearUserCache($user->username);
        auth()->logout();
        return response()->json(['message' => 'Đăng xuất thành công !!! ']);
    }

    public function changePassword(ChangePasswordRequest $passwordData)
    {
        $user = auth('api')->user();
        $token = $this->userRepository->changePassword($passwordData);

        if (!$token) {
            return response()->json(['error' => 'Mật khẩu cũ không chính xác.'], 422);
        }
        $this->userRepository->clearUserCache($user->username);
        auth('api')->logout();

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'access_token' => $token
        ]);
    }
}
