<?php

namespace App\Http\Controllers\frontend\api;

use JWTAuth;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Cookie;
use Session;
class ApiLoginController extends Controller
{
    public $loginAfterSignUp = true;

    public function getAll()
    {
        $user = User::all();
        return response()->json(['data'=>$user,'status'=>true]);
    }

    public function Login(Request $request)
    {
        $input = $request->only('email', 'password');

        $token = null;


        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }    

        return response()->json([
            'status' => true,
            'token' => $token,
        ]);
    }

    public function Logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);

        try {
            JWTAuth::invalidate($request->token);

            return response()->json([
                'status' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'status' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }
}
