<?php

namespace App\Http\Controllers\frontend\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Order;
use App\Model\Product;
use App\Model\Province;
use App\Model\District;
use App\Model\ProductImage;
use Carbon\Carbon;
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

    public function index(Request $request)
    {
        $result = null;
        $dateNow = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        if($request->keyword!=''&&$request->url!=''){
            $result = Product::leftJoin('bds_province as tinh','bds_product.province_id','=','tinh.id')
                            ->leftJoin('bds_district as dist','bds_product.district_id','=','dist.id')
                            ->leftJoin('bds_ward as ward','bds_product.ward_id','=','ward.id')
                            ->select('bds_product.*')
                            ->where('ward.url','like','%'.$request->url.'%')
                            ->where('bds_product.address','like','%'.$request->keyword.'%')
                            ->whereDate('bds_product.date_end','>=',$dateNow)
                            ->with(['ProductImages','Slugs'])
                            ->orderBy('bds_product.type_id','desc')
                            ->paginate(6);
        }else{
            $result = Product::leftJoin('bds_province as tinh','bds_product.province_id','=','tinh.id')
                            ->leftJoin('bds_district as dist','bds_product.district_id','=','dist.id')
                            ->leftJoin('bds_ward as ward','bds_product.ward_id','=','ward.id')
                            ->select('bds_product.*')
                            ->where('tinh.url','like','%'.$request->url.'%')
                            ->whereDate('bds_product.date_end','>=',$dateNow)
                            ->orWhere('dist.url','like','%'.$request->url.'%')
                            ->whereDate('bds_product.date_end','>=',$dateNow)
                            ->orWhere('ward.url','like','%'.$request->url.'%')
                            ->whereDate('bds_product.date_end','>=',$dateNow)
                            ->with(['ProductImages','Slugs'])
                            ->orderBy('bds_product.type_id','desc')
                            ->paginate(6);
        }

        return response()->json([
            'status'=>true,
            'data'=>$result,
            'errors'=>null
        ]);
    }
}
