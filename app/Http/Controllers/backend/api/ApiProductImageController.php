<?php

namespace App\Http\Controllers\backend\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\ProductImage;
class ApiProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // http://localhost:8000/api/admin/image/list
    public function index()
    {
        $image = ProductImage::paginate(10);
        return response()->json([
            'status'=>true,
            'data'=>$image,
            'errors'=>null
        ]);
    }
    // http://localhost:8000/api/admin/image/delete/38
    public function destroy($id)
    {
        $image = ProductImage::findOrFail($id);
        $path = public_path()."/assets/image_product/";
        if(file_exists($path.$image->image)){
            unlink($path.$image->image);
            if($image->delete()){
                return response()->json([
                    'status'=>true,
                    'data'=>null,
                    'errors'=>null
                ]);
            }
        }
    }
    // http://localhost:8000/api/admin/image/seach?keyword=30
    public function seach(Request $request)
    {
        $result = DB::table('bds_product as pro')
                    ->rightJoin('bds_product_image as img','pro.id','=','img.product_id')
                    ->select('img.*')
                    ->where('pro.id','=',$request->keyword)
                    ->orWhere('img.id','=',$request->keyword)
                    ->get();
        return response()->json([
            'status'=>true,
            'data'=>$result,
            'errors'=>null
        ]);
    }
}
