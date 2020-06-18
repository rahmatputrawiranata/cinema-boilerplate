<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\LoginToken;
class AuthUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = LoginToken::where('token', $request->token)->first();
        $user = $user->user;

        $role = $user->role;

        if($role !== 'user')
        {
            return response()->json([
                'message' => 'unauthorized user'
            ], 401);
        }
        return $next($request);
    }
}
