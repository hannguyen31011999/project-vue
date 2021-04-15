<?php

namespace App\Http\Controllers\backend\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Model\User;
class ApiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // http://localhost:8000/api/admin/user/list
    public function index()
    {
        $user = User::where('id_role',2)->paginate(10);
        return response()->json([
            'status'=>true,
            'data'=>$user,
            'errors'=>null
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // http://localhost:8000/api/admin/user/edit/6
    public function edit($id)
    {
        try{
            $user = User::findOrFail($id);
            return response()->json([
                'status'=>true,
                'data'=>$user,
                'errors'=>null
            ]);
        }catch(Exception $e){

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // 
    // http://localhost:8000/api/admin/user/update/6?fullname=Nguyễn Việt Hà&cmnd=098765432199&phone=0382333777
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'fullname'=>'required|max:255|regex:[^[a-zA-Z]]',
                'address'=>'max:255',
                'cmnd'=>'required|numeric|regex:/[0-9]{12}/',
                'phone'=>'required|numeric|regex:/(0)[0-9]{9}/'
            ],
            [
                'fullname.required'=>'Họ tên đang trống',
                'fullname.max'=>'Họ tên quá dài',
                'fullname.regex'=>'Họ tên là chữ',
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
                'status'=>false,
                'data'=>null,
                'errors'=>$validator->errors()
            ]);
        }else{
            try{
                $user = User::findOrFail($id);
                $user->update($request->all());
                return response()->json([
                    'status'=>true,
                    'data'=>$user,
                    'errors'=>null
                ]);
            }catch(Exception $e){
                return response()->json([
                    'status'=>false,
                    'data'=>null,
                    'errors'=>null
                ],500);
            } 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // http://localhost:8000/api/admin/user/seach?keyword=7
    public function seach(Request $request)
    {
        try{
            $user = User::where('id_role',2)
                        ->where(function($query) use ($request){
                            return $query->where('id',$request->keyword)
                                            ->orWhere('fullname','like',$request->keyword.'%')
                                            ->orWhere('email','like',$request->keyword.'%')
                                            ->orWhere('cmnd','like',$request->keyword.'%')
                                            ->orWhere('phone','like',$request->keyword.'%');
                        })->take(5)->get();
            return response()->json([
                'status'=>true,
                'data'=>$user,
                'errors'=>null
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'=>false,
                'data'=>null,
                'errors'=>null
            ],500);
        }
    }
}
