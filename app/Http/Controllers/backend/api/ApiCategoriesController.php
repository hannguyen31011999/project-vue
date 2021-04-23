<?php

namespace App\Http\Controllers\backend\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Model\Categories;
class ApiCategoriesController extends Controller
{
    private $statusFails = 400;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // http://localhost:8000/api/admin/categories/list?page=1
    public function index()
    {
        $categories = Categories::paginate(5);
        return response()->json([
            'data'=>$categories,
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

    // http://localhost:8000/api/admin/categories/create?categories_name=demo
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'categories_name'=>'required|unique:bds_categories,categories_name|max:255'
            ],
            [
                'categories_name.required'=>'Categories invalid',
                'categories_name.unique'=>'Categories is exist',
                'categories_name.max'=>'Character in categories so long'
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
                $input = [
                    'categories_name'=>$request->categories_name,
                    'url'=>utf8tourl($request->categories_name)
                ];
                $categories = Categories::create($input);
                return response()->json([
                    'data'=>$categories,
                    'status'=>true,
                    'errors'=>null
                ]);
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

    //  http://localhost:8000/api/admin/categories/edit/1
    public function edit($id)
    {
        try{
            $categories = Categories::findOrFail($id);
            return response()->json([
                'data'=>$categories,
                'status'=>true,
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
    
    //  http://localhost:8000/api/admin/categories/update/1?categories_name=abc
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'categories_name'=>'required|unique:bds_categories,categories_name|max:255'
            ],
            [
                'categories_name.required'=>'Categories invalid',
                'categories_name.unique'=>'Categories is exist',
                'categories_name.max'=>'Character in categories so long'
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
                $input = [
                    'categories_name'=>$request->categories_name,
                    'url'=>utf8tourl($request->categories_name)
                ];
                $categories = Categories::findOrFail($id);
                if($categories->update($input)){
                    return response()->json([
                        'data'=>$categories,
                        'status'=>true,
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

    //  http://localhost:8000/api/admin/categories/delete/7
    public function destroy($id)
    {
        try{
            $categories = Categories::findOrFail($id)->delete();
            if($categories){
                return response()->json([
                    'status'=>true,
                    'errors'=>null
                ]);
            }
            
        }catch(Exception $e){
            return response()->json([
                'status'=>false,
                'errors'=>null
            ]);
        }
    }

    // http://localhost:8000/api/admin/categories/seach?keyword=12
    public function seach(Request $request)
    {
        $categories = Categories::where('id',$request->keyword)
                                    ->orWhere('categories_name','like',$request->keyword.'%')
                                    ->take(5)
                                    ->get();
        return response()->json([
            'data'=>$categories,
            'status'=>true,
            'errors'=>null
        ]);
    }
}
