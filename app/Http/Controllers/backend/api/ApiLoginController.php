<?php

namespace App\Http\Controllers\backend\api;

use JWTAuth;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Auth;
class ApiLoginController extends Controller
{
    private $successStatus = 200;
    private $failStatus = 401;

    public function login(Request $request)
    {
        $input = $request->only('email','password');
        $remember = !empty($request->remember_token) ? true : false;
        $token = null;
        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'status' => false,
                'message' => 'Invalid Email or Password',
            ],$this->failStatus);
        }else{
            if(JWTAuth::user()->id_role==1){
                return response()->json([
                    'status' => true,
                    'token' => $token,
                ],$this->successStatus);
            }
        }
    }

    public function getUserLogin(Request $request)
    {
        $user = JWTAuth::setToken($_COOKIE['_token'])->toUser();
        return response()->json(['user'=>$user,'status'=>true],$this->successStatus);   
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            setcookie('_token', false);
            return response()->json([
                'status' => true,
                'message' => 'User logged out successfully'
            ],$this->successStatus);
        } catch (JWTException $exception) {
            return response()->json([
                'status' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }
}
