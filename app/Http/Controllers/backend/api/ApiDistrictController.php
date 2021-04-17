<?php

namespace App\Http\Controllers\backend\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Model\District;
use App\Model\Province;
use App\Model\Ward;
class ApiDistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // http://localhost:8000/api/admin/district/list
    public function index()
    {
        $data = District::with('Provinces')->paginate(10);
        $province = Province::orderBy('province_name')->get();
        return response()->json([
            'status'=>true,
            'data'=>[
                'district'=>$data,
                'province'=>$province
            ],
            'errors'=>null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  http://localhost:8000/api/admin/district/create?province_id=3&district_name=Ba Đình
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'province_id'=>'required',
                'district_name'=>'required|max:255|unique:bds_district,district_name'
            ],
            [
                'province_id.required'=>'province is invalid',
                'district_name.required'=>'district is valid',
                'district_name.unique'=>'district is exist'
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
                $input = [
                    'province_id'=>(int)$request->province_id,
                    'district_name'=>$request->district_name
                ];
                $create = District::create($input);
                if(!empty($create)){
                    return response()->json([
                        'status'=>true,
                        'data'=>$create,
                        'errors'=>null
                    ]);
                }
            }catch(Exception $e){

            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // http://localhost:8000/api/admin/district/edit/28
    public function edit($id)
    {
        try{
            $edit = District::findOrFail($id);
            return response()->json([
                'status'=>true,
                'data'=>$edit,
                'errors'=>null
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'=>true,
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

    //  http://localhost:8000/api/admin/district/update/28?province_id=3&district_name=Ba Đình
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'province_id'=>'required',
                'district_name'=>'required|max:255|unique:bds_district,district_name'
            ],
            [
                'province_id.required'=>'province is invalid',
                'district_name.required'=>'district is valid',
                'district_name.unique'=>'district is exist'
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
                $input = [
                    'province_id'=>(int)$request->province_id,
                    'district_name'=>$request->district_name
                ];
                $update = District::findOrFail($id);
                $update->update($input);
                if(!empty($update)){
                    return response()->json([
                        'status'=>true,
                        'data'=>[
                            'district'=>$update,
                            'province'=>$update->Provinces()->get()
                        ],
                        'errors'=>null
                    ]);
                }
            }catch(Exception $e){

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
        $delete = District::findOrFail($id)->delete();
        if($delete){
            return response()->json([
                'status'=>true,
                'data'=>null,
                'errors'=>null
            ]);
        }
    }

    // http://localhost:8000/api/admin/district/seach?keyword=Hồ Chí Minh
    public function seach(Request $request)
    {
        try{
            $result = DB::table('bds_district')
                        ->leftJoin('bds_province','bds_district.province_id','=','bds_province.id')
                        ->select('bds_district.*','bds_province.province_name')
                        ->where('bds_district.id','like',$request->keyword)
                        ->orWhere('bds_district.district_name','like',$request->keyword.'%')
                        ->orWhere('bds_province.province_name','like','%'.$request->keyword)
                        ->orderBy('bds_district.district_name')
                        ->take(10)
                        ->get();
            return response()->json([
                'status'=>true,
                'data'=>$result,
                'errors'=>null
            ]);
        }catch(Exception $e){

        }
    }

    // http://localhost:8000/api/admin/district/view/1
    public function viewListWard($id)
    {
        try{
            $data = District::findOrFail($id)->Wards()->get();
            return response()->json([
                'status'=>true,
                'data'=>$data,
                'errors'=>null
            ]);
        }catch(Exception $e){
            return response()->json([
                'status'=>true,
                'data'=>null,
                'errors'=>null
            ],500);
        }
    }
}
