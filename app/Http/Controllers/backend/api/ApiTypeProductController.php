<?php

namespace App\Http\Controllers\backend\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\TypeProduct;
class ApiTypeProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // http://localhost:8000/api/admin/type/list
    public function index()
    {
        $type = TypeProduct::paginate(5);
        return response()->json([
            'data'=>$type,
            'status'=>true,
            'errors'=>null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  http://localhost:8000/api/admin/type/create?name=Tin thường&price=2727
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name'=>'required|unique:bds_product_type,name|max:255',
                'price'=>'required'
            ],
            [
                'name.required'=>'type name invalid',
                'name.unique'=>'type name is exist',
                'name.max'=>'character in typename so long',
                'price.required'=>'price invalid'
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
                $type = TypeProduct::create($request->all());
                return response()->json([
                    'data'=>$type,
                    'status'=>true,
                    'errors'=>null
                ]);
            }catch(Exception $e){

            }
        }
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

    // http://localhost:8000/api/admin/type/edit/7
    public function edit($id)
    {
        try{
            $type = TypeProduct::findOrFail($id);
            return response()->json([
                'status'=>true,
                'data'=>$type,
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

    // http://localhost:8000/api/admin/type/update/7?name=abc123&price=23453
    public function update(Request $request, $id)
    {
        //
        $validator = Validator::make($request->all(),
            [
                'name'=>'required|unique:bds_product_type,name|max:255',
                'price'=>'required'
            ],
            [
                'name.required'=>'type name invalid',
                'name.unique'=>'type name is exist',
                'name.max'=>'character in typename so long',
                'price.required'=>'price invalid'
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
                $type = TypeProduct::findOrFail($id);
                $type->update($request->all());
                return response()->json([
                    'data'=>$type,
                    'status'=>true,
                    'errors'=>null
                ]);
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

    //  http://localhost:8000/api/admin/type/delete/7
    public function destroy($id)
    {
        try{
            $type = TypeProduct::findOrFail($id)->delete();
            if($type){
                return response()->json([
                    'data'=>null,
                    'status'=>true,
                    'errors'=>null
                ]);
            }
        }catch(Exception $e){

        }
    }

    // http://localhost:8000/api/admin/type/seach?keyword=1000
    public function seach(Request $request)
    {
        try{
            $type = TypeProduct::where('name','like',$request->keyword.'%')
                            ->orWhere('price','<=',$request->keyword)
                            ->take(5)
                            ->get();
            return response()->json([
                'data'=>$type,
                'status'=>true,
                'errors'=>null
            ]);
        }catch(Exception $e){

        }
        
    }
}
