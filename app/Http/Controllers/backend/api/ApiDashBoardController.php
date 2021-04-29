<?php

namespace App\Http\Controllers\backend\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Order;
use App\Model\Visitor;
use App\Model\User;
use App\Model\Post;
use App\Model\Product;
use Carbon\Carbon;
class ApiDashBoardController extends Controller
{
    public function index()
    {
        $datePresent = Carbon::now();
        $count = [];
        $result = Order::select(
            DB::raw('sum(price*total_date) as `total` '),
            DB::raw("DATE_FORMAT(created_at,'%D %M') as days"))
            ->whereMonth('created_at','=',$datePresent->month)
            ->groupBy('days')
            ->get();
        $count['visit'] = Visitor::whereDay('created_at','=',$datePresent->day)->count();
        $count['order'] = Order::whereDay('created_at','=',$datePresent->day)->count();
        $count['user'] = User::whereDay('created_at','=',$datePresent->day)->count();
        $count['post'] = Post::whereDay('created_at','=',$datePresent->day)->count();
        $categories = Product::with('Categories')
                            ->select(
                                DB::raw('count(*) as `total`'),
                                DB::raw('categories_id')
                            )->groupBy('categories_id')->get();
        return response()->json([
            'status'=>true,
            'data'=>[
                'count'=>$count,
                'data'=>$result,
                'categories'=>$categories
            ],
            'errors'=>null
        ]);
    }
}
