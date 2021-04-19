<?php

namespace App\Http\Controllers\backend\api;

use JWTAuth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Model\Post;
class ApiPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Post::with('Users')->paginate(10);
        return response()->json([
            'status'=>true,
            'data'=>$data,
            'errors'=>null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  http://localhost:8000/api/admin/post/create?image=123.jpg&title=Những ngày thu vừa qua&content=123dsa
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'title'=>'required|max:255',
                'content'=>'required',
                'image'=>'required|mimes:jpg,jpeg,png,|max:2048'
            ],
            [
                'title.required'=>'title is invalid',
                'content.required'=>'content is invalid',
                'image.required'=>'image is invalid',
                'image.image'=>'type of photo jpeg,png,jpg',
                'image.max'=>'maximum 2048 kb',
            ]
        );
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'data'=>null,
                'errors'=>$validator->errors()
            ]);
        }else{
            if($request->hasFile('image')){
                $file = $request->file('image');
                try{
                    $input = [
                        'user_id'=>JWTAuth::toUser($request->token)->id,
                        'title'=>$request->title,
                        'content'=>$request->content,
                        'image'=>$file->getClientOriginalName(),
                        'url'=>utf8tourl($request->title)
                    ];
                    $create = Post::create($input);
                    if(!empty($create)){
                        $file->move('assets/image_post',$file->getClientOriginalName());
                        return response()->json([
                            'status'=>true,
                            'data'=>$create,
                            'errors'=>null
                        ]);
                    }
                }catch(Exception $e){
                    return response()->json([
                        'status'=>false,
                        'data'=>null,
                        'errors'=>null
                    ],500);
                }
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $edit = Post::findOrFail($id);
            return response()->json([
                'status'=>true,
                'data'=>$edit,
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
    public function update(Request $request, $id)
    {
        $input = [
            'user_id'=>JWTAuth::toUser($request->token)->id,
            'title'=>$request->title,
            'content'=>$request->content,
            'url'=>utf8tourl($request->title)
        ];
        $path = public_path()."/assets/image_post/";
        $validator = Validator::make($request->all(),
            [
                'title'=>'required|max:255',
                'content'=>'required',
            ],
            [
                'title.required'=>'title is invalid',
                'content.required'=>'content is invalid',
            ]
        );
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'data'=>null,
                'errors'=>$validator->errors()
            ]);
        }else{
            if($request->hasFile('image')){
                $validator = Validator::make($request->all(),
                    [
                        'image'=>'mimes:jpg,jpeg,png,|max:2048'
                    ],
                    [
                        'image.image'=>'type of photo jpeg,png,jpg',
                        'image.max'=>'maximum 2048 kb',
                    ]
                );
                if($validator->fails()){
                    return response()->json([
                        'status'=>false,
                        'data'=>null,
                        'errors'=>$validator->errors()
                    ]);
                }
                $file = $request->file('image');
                $file->move('assets/image_post',$file->getClientOriginalName());
                $input['image'] = $file->getClientOriginalName();
            }

            try{
                $update = Post::findOrFail($id);
                if(file_exists($path.$update->image)&&array_key_exists('image',$input)){
                    unlink($path.$update->image);
                }
                $update->update($input);
                if(!empty($update)){
                    return response()->json([
                        'status'=>true,
                        'data'=>[
                            'post'=>$update,
                            'user'=>$update->Users()->get()
                        ],
                        'errors'=>null
                    ]);
                }
            }catch(Exception $e){
                return response()->json([
                    'status'=>false,
                    'data'=>null,
                    'errors'=>null
                ],500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Post::findOrFail($id);
        $path = public_path()."/assets/image_post/";
        if(file_exists($path.$delete->image)){
            unlink($path.$delete->image);
        }
        $bool = $delete->delete();
        if($delete){
            return response()->json([
                'status'=>true,
                'data'=>null,
                'errors'=>null
            ]);
        }
    }

    // http://localhost:8000/api/admin/post/seach?keyword=Nguyễn
    public function seach(Request $request)
    {
        $result = DB::table('bds_post')
                    ->leftJoin('bds_user','bds_post.user_id','=','bds_user.id')
                    ->select('bds_post.*','bds_user.fullname')
                    ->where('bds_post.id','=',$request->keyword)
                    ->orWhere('bds_user.fullname','like','%'.$request->keyword.'%')
                    ->orderBy('bds_post.id','ASC')
                    ->take(5)
                    ->get();
        return response()->json([
            'status'=>true,
            'data'=>$result,
            'errors'=>null
        ]);
    }
}
