<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckJwtVersion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle($request, Closure $next)
    {
        $id = auth('api')->id();
        $token = JWTAuth::getToken();
        $tokenJwtVersion = JWTAuth::decode($token)->get('jwt_version');

        $cacheKey = 'jwt_version:' . $id;

        $cachedVersion = intval(Cache::remember($cacheKey, $minutes = 60, function () use ($id) {
            return $this->user->find($id)->jwt_version;
        }));
        if ($tokenJwtVersion !== $cachedVersion) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        return $next($request);
    }
}
