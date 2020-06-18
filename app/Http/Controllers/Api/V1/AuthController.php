<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\User;
use App\Models\LoginToken;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    public function login(Request $request)
    {   
        $data = User::where('username' , $request->username)->first();
        if(!$data)
        {
            return response()->json([
                'message' => 'invalid login'
            ], 401);
        }
        if(!Hash::check($request->input('password'), $data->password)){
            return response()->json([
                'message' => 'invalid login'
            ], 401);
        }
        $token = Hash::make(Str::random(60));
        $createToken = LoginToken::updateOrCreate(
            ['user_id' => $data->id],
            ['token' => $token]
        );
        $createToken->save();
        return response()->json([
            'token' => $token,
            'role' => $data->role
        ], 200);
    }

    public function logout(Request $request)
    {
        $user = LoginToken::where('token' , $request->token)->first();

        $user = $user->user;
        

        LoginToken::where('user_id', $user->id)->delete();

        return response()->json([
            'message' => 'logout success'
        ], 200);
    }
}
