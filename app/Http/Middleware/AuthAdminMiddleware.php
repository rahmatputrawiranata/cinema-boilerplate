<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\LoginToken;
class AuthAdminMiddleware
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

        if($role !== 'admin')
        {
            return response()->json([
                'message' => 'access forbidden'
            ], 403);
        }
        return $next($request);
    }
}
