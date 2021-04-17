<?php

namespace App\Http\Controllers\backend\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Model\District;
use App\Model\Province;
use App\Model\Ward;
class ApiWardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // http://localhost:8000/api/admin/ward/list
    public function index()
    {
        $ward = Ward::with(['Districts','Provinces'])->paginate(10);
        $province = Province::orderBy('province_name')->get();
        return response()->json([
            'status'=>true,
            'data'=>[
                'province'=>$province,
                'ward'=>$ward
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

    // http://localhost:8000/api/admin/ward/create?province_id=1&district_id=1&ward_name=abbb
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'province_id'=>'required',
                'district_id'=>'required',
                'ward_name'=>'required|max:255|unique:bds_ward,ward_name'
            ],
            [
                'province_id.required'=>'province is valid',
                'district_id.required'=>'district is valid',
                'ward_name.required'=>'ward is valid',
                'ward_name.max'=>'maximum 255 character',
                'ward_name.unique'=>'ward is exist'
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
                $create = Ward::create($request->all());
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

    //  http://localhost:8000/api/admin/ward/edit/312
    public function edit($id)
    {
        try{
            $edit = Ward::findOrFail($id);
            if(!empty($edit)){
                return response()->json([
                    'status'=>true,
                    'data'=>$edit,
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  http://localhost:8000/api/admin/ward/update/312?province_id=1&district_id=1&ward_name=ababa
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'province_id'=>'required',
                'district_id'=>'required',
                'ward_name'=>'required|max:255|unique:bds_ward,ward_name'
            ],
            [
                'province_id.required'=>'province is valid',
                'district_id.required'=>'district is valid',
                'ward_name.required'=>'ward is valid',
                'ward_name.max'=>'maximum 255 character',
                'ward_name.unique'=>'ward is exist'
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
                $update = Ward::findOrFail($id);
                $update->update($request->all());
                if(!empty($update)){
                    return response()->json([
                        'status'=>true,
                        'data'=>[
                            'province'=>$update->Provinces()->get(),
                            'district'=>$update->Districts()->get(),
                            'ward'=>$update
                        ],
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  http://localhost:8000/api/admin/ward/delete/312
    public function destroy($id)
    {
        $delete = Ward::findOrFail($id)->delete();
        if($delete){
            return response()->json([
                'status'=>true,
                'data'=>null,
                'errors'=>null
            ]);
        }
    }

    // http://localhost:8000/api/admin/ward/seach?keyword=1
    public function seach(Request $request)
    {
        $result = DB::table('bds_ward')
                    ->leftJoin('bds_district','bds_ward.district_id','=','bds_district.id')
                    ->leftJoin('bds_province','bds_ward.province_id','=','bds_province.id')
                    ->select('bds_ward.*','bds_district.district_name','bds_province.province_name')
                    ->where('bds_ward.id','=',$request->keyword)
                    ->orWhere('bds_ward.ward_name','like','%'.$request->keyword.'%')
                    ->orWhere('bds_district.district_name','like','%'.$request->keyword.'%')
                    ->orWhere('bds_province.province_name','like','%'.$request->keyword.'%')
                    ->orderBy('bds_ward.ward_name')
                    ->take(5)
                    ->get();
        if(!empty($result)){
            return response()->json([
                'status'=>true,
                'data'=>$result,
                'errors'=>null
            ]);
        }
    }

    // http://localhost:8000/api/admin/ward/change/district/1
    public function changeDistrict($id)
    {
        $data = Province::findOrFail($id)->Districts()->get();
        return response()->json([
            'status'=>true,
            'data'=>$data,
            'errors'=>null
        ]);
    }
}
