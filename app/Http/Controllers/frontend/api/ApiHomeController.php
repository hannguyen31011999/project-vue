<?php

namespace App\Http\Controllers\frontend\api;

use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;
use App\Model\Categories;
use App\Model\User;
use App\Model\Post;
use App\Model\Province;
use App\Model\District;
use App\Model\Product;
use App\Model\Ward;
use App\Model\Visitor;
use Carbon\Carbon;
class ApiHomeController extends Controller
{
    // http://localhost:8000/api/categories/list
    public function getListCategories()
    {
        $categories = Categories::all();
        return response()->json([
            'data'=>$categories,
            'status'=>true,
            'errors'=>null,
        ]);
    }


    // http://localhost:8000/api/post/list
    public function getListPost()
    {
        // $post = DB::table('bds_post')
        //             ->leftJoin('bds_user','bds_post.user_id','=','bds_user.id')
        //             ->select('bds_post.id','bds_post.title','bds_post.image','bds_post.url','bds_post.created_at','bds_user.fullname')
        //             ->whereMonth('bds_post.created_at',Carbon::now()->month)
        //             ->orderBy('bds_post.created_at','desc')
        //             ->take(4)
        //             ->get();
        $post = Post::whereMonth('created_at',Carbon::now()->month)
                    ->orderBy('created_at','desc')
                    ->take(3)
                    ->get(['id','title','image','url','created_at']);
        return response()->json([
            'data'=>$post,
            'status'=>true,
            'errors'=>null,
        ]);
    }

    // http://localhost:8000/api/product/list
    public function getListProduct()
    {
        $dateNow = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $product = Product::where('date_end','>=',$dateNow)
                            ->where('type_id','=',6)
                            ->orWhere('type_id','=',3)
                            ->orWhere('type_id','=',4)
                            ->with(['ProductImages','Slugs'])
                            ->orderBy('created_at','desc')
                            ->take(6)
                            ->get();
        return response()->json([
            'status'=>true,
            'data'=>$product,
            'errors'=>null,
        ]);
    }

    // 
    public function getListProvince()
    {
        $province = Province::with(['Districts','Wards'])->get();
        return response()->json([
            'status'=>true,
            'data'=>$province,
            'errors'=>null
        ]);
    }

    public function Count()
    {
        $count = [];
        $count['product'] = Product::count();
        $count['user'] = User::where('id_role','=',2)->count();
        $count['post'] = Post::count();
        $count ['visitor'] = Visitor::count();

        return response()->json([
            'status'=>true,
            'data'=>$count,
            'errors'=>null
        ]);
    }

    // http://localhost:8000/api/register?fullname=Nguy???n V??n D???ng&email=dungnguyen1960@gmail.com&password=123456&birth_date=06-02-1960&gender=0&address=129/15 ???????ng 154,ph?????ng T??n Ph??,TP Th??? ?????c&cmnd=027927026666&phone=0382484040
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
                'fullname.required'=>'H??? t??n ??ang tr???ng',
                'fullname.max'=>'H??? t??n qu?? d??i',
                'fullname.regex'=>'H??? t??n l?? ch???',
                'email.email'=>'Kh??ng ????ng ?????nh d???ng email',
                'email.unique'=>'Email t???n t???i',
                'email.max'=>'Email qu?? d??i',
                'email.required'=>'Email ??ang tr???ng',
                'password.required'=>'M???t kh???u ??ang tr???ng',
                'password.min'=>'M???t kh???u ??t h??n 6 k?? t???',
                'password.max'=>'M???t kh???u qu?? d??i',
                'cmnd.required'=>'Ch???ng minh nh??n d??n ??ang tr???ng',
                'cmnd.regex'=>'Ch???ng minh nh??n sai ?????nh d???ng',
                'cmnd.numeric'=>'Ch???ng minh nh??n ph???i l?? s???',
                'phone.required'=>'S??? ??i???n tho???i ??ang tr???ng',
                'phone.regex'=>'S??? ??i???n tho???i sai ?????nh d???ng',
                'phone.numeric'=>'S??? ??i???n tho???i ph???i l?? s???'
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
                'email.required'=>'Email ??ang tr???ng',
                'email.email'=>'Email sai ?????nh d???ng',
                'password.required'=>'M???t kh???u ??ang tr???ng'
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
                    'wrong' => 'Email ho???c m???t kh???u sai',
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
                        'wrong' => 'Email ho???c m???t kh???u sai',
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

    public function seach(Request $request)
    {
        $datePresent = Carbon::now();
        $result = null;
        $url = null;
        if($request->categories_id!=null&&$request->categories_id!='0'){
            if($request->province_id!=null&&$request->province_id!='0')
            {
                if($request->district_id!=null&&$request->district_id!='0')
                {
                    if($request->ward_id!=null&&$request->ward_id!='0')
                    {
                        if($request->keyword!=null)
                        {
                            $ward = Ward::Where('id','=',$request->ward_id)->first();
                            $result = $ward->url.'?q='.($request->keyword);
                            $url = $request->keyword;
                        }
                        else
                        {
                            $result = Ward::Where('id','=',$request->ward_id)->first();
                        }
                    }
                    else
                    {
                        $result = District::Where('id','=',$request->district_id)->first();
                    }
                }
                else
                {
                    $result = Province::Where('id','=',$request->province_id)->first();
                }
            }
            else
            {
                $result = Categories::Where('id','=',$request->categories_id)->first();
            }
        }
        else
        {
            if($request->province_id!=null&&$request->province_id!='0')
            {
                if($request->district_id!=null&&$request->district_id!='0')
                {
                    if($request->ward_id!=null&&$request->ward_id!='0')
                    {
                        if($request->keyword!=null)
                        {
                            $ward = Ward::Where('id','=',$request->ward_id)->first();
                            $result = $ward->url.'?q='.utf8tourl($request->keyword);
                            $url = $request->keyword;
                        }
                        else
                        {
                            $result = Ward::Where('id','=',$request->ward_id)->first();
                        }
                    }
                    else
                    {
                        $result = District::Where('id','=',$request->district_id)->first();
                    }
                }
                else
                {
                    $result = Province::Where('id','=',$request->province_id)->first();
                }
            }
        }
        if(!empty($result)&&empty($url)){
            return response()->json([
                'status'=>true,
                'data'=>$result,
                'errors'=>null
            ]);
        }else{
            return response()->json([
                'status'=>true,
                'data'=>$result,
                'url'=>$url
            ]);
        }
    }
}
