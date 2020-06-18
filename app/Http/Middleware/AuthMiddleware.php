<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\LoginToken;
class AuthMiddleware
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

        $getToken = LoginToken::where('token' , $request->input('token'))->first();
        if(!$getToken)
        {
            return response()->json([
                'message' => 'unauthorized user'
            ], 401);
        }
        return $next($request);
    }
}
