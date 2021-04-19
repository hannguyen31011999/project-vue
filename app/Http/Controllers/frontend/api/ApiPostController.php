<?php

namespace App\Http\Controllers\frontend\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Post;
use Carbon\Carbon;
class ApiPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    // http://localhost:8000/api/post/detail/bong-tay-voi-gia-nha-lien-tho
    public function getPostDetail($url)
    {
        $post = DB::table('bds_post')
                    ->leftJoin('bds_user','bds_post.user_id','=','bds_user.id')
                    ->select('bds_post.id','bds_post.content','bds_post.created_at','bds_user.fullname')
                    ->where('bds_post.url','like','%'.$url.'%')
                    ->first();
        $relate = Post::where('url','NOT LIKE','%'.$url.'%')
                        ->whereMonth('created_at',Carbon::now()->month)
                        ->orderBy('created_at','desc')
                        ->take(4)
                        ->get(['id','title','image','url','created_at']);
        return response()->json([
            'status'=>true,
            'data'=>[
                'post'=>$post,
                'relate'=>$relate
            ],
            'errors'=>null
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
