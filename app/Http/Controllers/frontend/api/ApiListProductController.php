<?php

namespace App\Http\Controllers\frontend\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Product;
use App\Model\Categories;
use Carbon\Carbon;
class ApiListProductController extends Controller
{
    // 
    public function index($url)
    {
        $categories = Categories::where('url','like','%'.$url.'%')->first();
        $date = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
        $product = Product::where('categories_id','=',$categories->id)
                            ->where('status','!=',0)
                            ->where('date_end','>=',$date)
                            ->with(['ProductImages','Slugs'])
                            ->orderBy('created_at','desc')
                            ->paginate(6);
        return response()->json([
            'status'=>true,
            'data'=>$product,
            'errors'=>null
        ]);
    }
}
