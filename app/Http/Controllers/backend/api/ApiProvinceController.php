<?php

namespace App\Http\Controllers\backend\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\Province;
class ApiProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // http://localhost:8000/api/admin/province/list
    public function index()
    {
        $province = Province::paginate(10);
        return response()->json([
            'status'=>true,
            'data'=>$province,
            'errors'=>null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  http://localhost:8000/api/admin/province/create?province_name=Hà Nội
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'province_name'=>'required|max:255|unique:bds_province,province_name'
            ],
            [
                'province_name.required'=>'province is valid',
                'province_name.unique'=>'province is exist'
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
                $create = Province::create([
                    'province_name'=>$request->province_name,
                    'url'=>utf8tourl($request->province_name)
                ]);
                if(!empty($create)){
                    return response()->json([
                        'status'=>true,
                        'data'=>$create,
                        'errors'=>null
                    ]);
                }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // http://localhost:8000/api/admin/province/edit/2
    public function edit($id)
    {
        try{
            $edit = Province::findOrFail($id);
            return response()->json([
                'status'=>true,
                'data'=>$edit,
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // http://localhost:8000/api/admin/province/update/2?province_name=Hà Lội
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'province_name'=>'required|max:255|unique:bds_province,province_name'
            ],
            [
                'province_name.required'=>'province is valid',
                'province_name.unique'=>'province is exist'
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
                $data = Province::findOrFail($id);
                $data->update([
                    'province_name'=>$request->province_name,
                    'url'=>utf8tourl($request->province_name)
                ]);
                return response()->json([
                    'status'=>true,
                    'data'=>$data,
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
    // http://localhost:8000/api/admin/province/delete/2
    public function destroy($id)
    {
        try{
            $bool = Province::findOrFail($id)->delete();
            if($bool){
                return response()->json([
                    'status'=>true,
                    'data'=>null,
                    'errors'=>null
                ]);
            }
        }catch(Exception $e){
            return response()->json([
                'status'=>false,
                'data'=>null,
                'errors'=>null
            ],500);
        }
    }

    // http://localhost:8000/api/admin/province/seach?keyword=hồ
    public function seach(Request $request)
    {
        try{
            $result = Province::where('id',$request->keyword)
                            ->orWhere('province_name','like',$request->keyword.'%')
                            ->take(5)
                            ->get();
            if(!empty($result)){
                return response()->json([
                    'status'=>true,
                    'data'=>$result,
                    'errors'=>null
                ]);
            }
        }catch(Exception $e){
            return response()->json([
                'status'=>false,
                'data'=>null,
                'errors'=>null
            ],500);
        }
    }

    // 
    public function viewDistrict(Request $request,$id)
    {
        try{
            $result = Province::findOrFail($id)
                                ->Districts()
                                ->get();
            if(!empty($result)){
                return response()->json([
                    'status'=>true,
                    'data'=>$result,
                    'errors'=>null
                ]);
            }
        }catch(Exception $e){
            return response()->json([
                'status'=>false,
                'data'=>null,
                'errors'=>null
            ],500);
        }
    }
}
