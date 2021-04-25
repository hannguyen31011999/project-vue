<?php

namespace App\Http\Controllers\frontend\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\Product;
class ApiSeachController extends Controller
{
    // http://localhost:8000/api/seach/order/04536522158
    public function seachOrder($str)
    {
        if(strlen($str)>8){
            $id = '';
            for($i = 0;$i < strlen($str);$i++){
                if($i > 8){
                    $id .= $str[$i];
                }
            }
            $product = Product::where('id','=',(int)$id)->first();
            if($product!=null){
                $order = $product->Orders()->first();
                $type = $product->Types()->first();
                $slug = $product->Slugs()->first();
                return response()->json([
                    'status'=>true,
                    'data'=>[
                        'product'=>$product,
                        'order'=>$order,
                        'type'=>$type,
                        'slug'=>$slug
                    ],
                    'errors'=>null
                ]);
            }else{
                return response()->json([
                    'status'=>false,
                    'data'=>null,
                    'errors'=>null
                ]);
            }
        }else{
            return response()->json([
                'status'=>false,
                'data'=>null,
                'errors'=>null
            ]);
        }
    }
}
