<?php

namespace App\Http\Controllers\frontend\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Product;
use App\Model\Post;
use App\Model\Slug;
use Carbon\Carbon;
class ApiProductDetailController extends Controller
{
    // http://localhost:8000/api/product/detail/100-can-biet-thu-vinhome-grand-park
    public function index($url)
    {
        $date = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $slug = Slug::where('url','like','%'.$url.'%')->first();
        $product = Product::where('id','=',(int)$slug->product_id)
                            ->where('date_end','>=',$date)
                            ->where('status','!=',0)
                            ->with(['ProductImages','Variants'])
                            ->first();
        
        if(!empty($product)){
            $relate = Product::where('status','!=',0)
                            ->where('date_end','>=',$date)
                            ->with(['ProductImages','Slugs'])
                            ->orderBy('created_at','desc')
                            ->take(2)
                            ->get();
            $post = Post::orderBy('created_at','desc')
                    ->take(3)
                    ->get();
            return response()->json([
                'status'=>true,
                'data'=>[
                    'product'=>$product,
                    'relate'=>$relate,
                    'post'=>$post
                ],
                'errors'=>null
            ]);
        }

        return response()->json([
            'status'=>false,
            'data'=>null,
            'errors'=>null
        ]);
    }
}
