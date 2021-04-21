<?php

namespace App\Http\Controllers\frontend\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Province;
use App\Model\Product;
use App\Model\ProductImage;
use App\Model\Order;
use App\Model\Variant;
use App\Model\TypeProduct;
use App\Model\Categories;
use Carbon\Carbon;
class ApiCreateProductController extends Controller
{
    // http://localhost:8000/api/product
    public function getList()
    {
        $province = Province::with(['districts','wards'])->get();
        $categories = Categories::all();
        $type = TypeProduct::all();
        
        return response()->json([
            'status'=>true,
            'data'=>[
                'province'=>$province,
                'categories'=>$categories,
                'type'=>$type
            ],
            'errors'=>null
        ]);
    }

    public function rangeTime(Request $request)
    {
        if($request->date_start!=''&&$request->date_end!=''){
            $start = Carbon::create($request->date_start);
            $end = Carbon::create($request->date_end);
            $totalDate = ($end->diffInDays($start) > 1) ? $end->diffInDays($start) + 1 : 1;
            if($totalDate==1){
                $total = $totalDate * TypeProduct::findOrFail($request->type_id)->price;
                return response([
                    'status'=>true,
                    'data'=>$total,
                    'errors'=>null
                ]);      
            }
            if($start->lt($end)){
                $total = $totalDate * TypeProduct::findOrFail($request->type_id)->price;
                return response([
                    'status'=>true,
                    'data'=>$total,
                    'errors'=>null
                ]);       
            }else{
                return response([
                    'status'=>false,
                    'data'=>null,
                    'errors'=>null
                ]);       
            }
        }
    }
}
