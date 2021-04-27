<?php

namespace App\Http\Controllers\backend\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Model\Product;
use App\Model\Categories;
use App\Model\Province;
use App\Model\District;
use App\Model\Ward;
class ApiProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // http://localhost:8000/api/admin/product/list
    public function index()
    {
        $product = Product::where('status','!=',0)
                            ->paginate(10);
        return response()->json([
            'status'=>true,
            'data'=>$product,
            'errors'=>null
        ]);
    }

    // http://localhost:8000/api/admin/product/edit/47
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Categories::all();
        $province = Province::all();
        $district = District::where('province_id','=',$product->province_id)->get();
        $ward = Ward::where('district_id','=',$product->district_id)->get();
        return response()->json([
            'status'=>true,
            'data'=>[
                'product'=>$product,
                'categories'=>$categories,
                'province'=>$province,
                'district'=>$district,
                'ward'=>$ward
            ],
            'errors'=>null
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // http://localhost:8000/api/admin/product/update/47?title=GIỎ HÀNG 100 CĂN NHÀ PHỐ THƯƠNG MẠI BIỆT THỰ SONG LẬP ĐƠN LẬP GIÁ GỐC CĐT VINHOMES GRAND PARK
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'title'=>'required|max:100',
                'area'=>'required',
                'price'=>'required',
                'address'=>'required',
                'desc'=>'required|max:3000',
                'date_start'=>'required',
                'date_end'=>'required'
            ],
            [
                'title.required'=>'title is invalid',
                'title.max'=>'maximum 100 character',
                'area.required'=>'area is invalid',
                'price.required'=>'price is invalid',
                'address.required'=>'address is invalid',
                'desc.required'=>'desc is invalid',
                'desc.max'=>'maximum 3000 character',
                'date_end.date_after'=>'date end must be greater date start'
            ]
        );
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'data'=>null,
                'errors'=>$validator->errors()
            ]);
        }else{
            $product = Product::findOrFail($id);
            if($product->update($request->all())){
                $product->Slugs()->update([
                    'url'=>utf8tourl($request->title)
                ]);
                return response()->json([
                    'status'=>true,
                    'data'=>$product,
                    'errors'=>null
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // http://localhost:8000/api/admin/product/delete/47
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if($product->delete()){
            return response()->json([
                'status'=>true,
                'data'=>null,
                'errors'=>null
            ]);
        }
    }

    // http://localhost:8000/api/admin/product/seach?keyword=riêng
    public function seach(Request $request)
    {
        $result = DB::table('bds_product as pro')
                    ->leftJoin('bds_product_type as type','pro.type_id','=','type.id')
                    ->leftJoin('bds_categories as cate','pro.categories_id','=','cate.id')
                    ->leftJoin('bds_province as proc','pro.province_id','=','proc.id')
                    ->leftJoin('bds_district as dist','pro.district_id','=','dist.id')
                    ->leftJoin('bds_ward as ward','pro.ward_id','=','ward.id')
                    ->leftJoin('bds_order as ord','ord.product_id','=','pro.id')
                    ->select('pro.*')
                    ->where('pro.id','=',$request->keyword)
                    ->orWhere(function($query) use($request){
                        $query->where('type.name','like','%'.$request->keyword.'%')
                                ->orWhere('cate.categories_name','like','%'.$request->keyword.'%')
                                ->orWhere('proc.province_name','like','%'.$request->keyword.'%')
                                ->orWhere('dist.district_name','like','%'.$request->keyword.'%')
                                ->orWhere('ward.ward_name','like','%'.$request->keyword.'%')
                                ->orWhere('ord.email','like','%'.$request->keyword.'%')
                                ->orWhere('ord.fullname','like','%'.$request->keyword.'%')
                                ->orWhere('ord.phone','like','%'.$request->keyword.'%')
                                ->orWhere('pro.title','like','%'.$request->keyword.'%')
                                ->orWhere('pro.address','like','%'.$request->keyword.'%');
                    })
                    ->orderBy('pro.created_at','desc')
                    ->take(10)
                    ->get();
        return response()->json([
            'status'=>true,
            'data'=>$result,
            'errors'=>null
        ]);
    }
}
