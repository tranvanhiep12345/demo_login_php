<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class EnsureEmailIsVerified
{
    public function handle($request, Closure $next)
    {
        if ($request->user() instanceof MustVerifyEmail &&
            !$request->user()->hasVerifiedEmail()) {
            return response()->json(['error' => 'Email chưa xác thực.'], 403);
        }
        return $next($request);
    }
}

