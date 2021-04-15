<?php

namespace App\Http\Controllers\frontend\api;

use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Model\Categories;
use App\Model\User;
class ApiHomeController extends Controller
{
    public function getCategories()
    {
        $categories = Categories::all();
        return response()->json([
            'data'=>$categories,
            'status'=>true,
            'errors'=>null,
        ]);
    }

    // http://localhost:8000/api/register?fullname=Nguyễn Văn Dụng&email=dungnguyen1960@gmail.com&password=123456&birth_date=06-02-1960&gender=0&address=129/15 đường 154,phường Tân Phú,TP Thủ Đức&cmnd=027927026666&phone=0382484040
    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'fullname'=>'required|max:255|regex:[^[a-zA-Z]]',
                'email'=>'required|max:100|email|unique:bds_user,email',
                'password'=>'required|max:255|min:6',
                'cmnd'=>'required|numeric|regex:/[0-9]{12}/',
                'phone'=>'required|numeric|regex:/(0)[0-9]{9}/'
            ],
            [
                'fullname.required'=>'Họ tên đang trống',
                'fullname.max'=>'Họ tên quá dài',
                'fullname.regex'=>'Họ tên là chữ',
                'email.email'=>'Không đúng định dạng email',
                'email.unique'=>'Email tồn tại',
                'email.max'=>'Email quá dài',
                'email.required'=>'Email đang trống',
                'password.required'=>'Mật khẩu đang trống',
                'password.min'=>'Mật khẩu ít hơn 6 kí tự',
                'password.max'=>'Mật khẩu quá dài',
                'cmnd.required'=>'Chứng minh nhân dân đang trống',
                'cmnd.regex'=>'Chứng minh nhân sai định dạng',
                'cmnd.numeric'=>'Chứng minh nhân phải là số',
                'phone.required'=>'Số điện thoại đang trống',
                'phone.regex'=>'Số điện thoại sai định dạng',
                'phone.numeric'=>'Số điện thoại phải là số'
            ]
        );

        if($validator->fails()){
            return response()->json([
                'data'=>null,
                'status'=>false,
                'errors'=>$validator->errors()
            ]);
        }else{
            try{
                $gender = ($request->gender=="0") ? 0 : 1;
                $register = [
                    'id_role'=>2,
                    'fullname'=>$request->fullname,
                    'email'=>$request->email,
                    'password'=>Hash::make($request->password),
                    'birth_date'=>date('Y-m-d',strtotime($request->birth_date)),
                    'gender'=>$gender,
                    'address'=>$request->address,
                    'cmnd'=>$request->cmnd,
                    'phone'=>$request->phone
                ];
                $createRegister = User::create($register);
                if(!empty($createRegister)){
                    return response()->json([
                        'data'=>$createRegister,
                        'status'=>true,
                        'errors'=>null
                    ]);
                }
            }catch(Exception $e){

            }
        }
    }

    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'email'=>'required|email',
                'password'=>'required',
            ],
            [
                'email.required'=>'Email đang trống',
                'email.email'=>'Email sai định dạng',
                'password.required'=>'Mật khẩu đang trống'
            ]
        );
        if($validator->fails()){
            return response()->json([
                'data'=>null,
                'status' => false,
                'errors' => $validator->errors(),
                'wrong' => null
            ]);
        }else{
            $input = $request->only('email','password');
            $token = null;
            if (!$token = JWTAuth::attempt($input)) {
                return response()->json([
                    'data'=>null,
                    'status' => false,
                    'errors'=>null,
                    'wrong' => 'Email hoặc mật khẩu sai',
                ]);
            }else{
                if(JWTAuth::user()->id_role==2){
                    return response()->json([
                        'status' => true,
                        'data' => $token,
                        'errors'=>null,
                        'wrong' => null
                    ]);
                }else{
                    return response()->json([
                        'status' => false,
                        'data' => null,
                        'errors'=>null,
                        'wrong' => 'Email hoặc mật khẩu sai',
                    ]);
                }
            }
        }
    }

    public function getUserLogin(Request $request)
    {
        $user = JWTAuth::setToken($request->token)->toUser();
        return response()->json([
            'data'=>$user,
            'status'=>true,
            'errors'=>null
        ]);   
    }

    public function logoutUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json([
                'status' => true,
                'data'=>null,
                'errors'=>null
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'status' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }
}
