<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\ProductImage;
class ViewFrontendController extends Controller
{
    private $module = 'frontend';

    public function viewIndex()
    {
        return view($this->module.'.home.index_home');
    }

    public function viewPostDetail()
    {
        return view($this->module.'.post.detail_post');
    }

    public function viewPost()
    {
        return view($this->module.'.post.list_post');
    }

    public function viewCreateProduct(Request $request)
    {
        if($request->vnp_ResponseCode!=''){
            if($request->vnp_ResponseCode=='00'){
                $product = Product::findOrFail($request->vnp_TxnRef)->update(['status'=>1]);
                return redirect('/dang-tin-rao-ban');
            }else{
                $path = public_path()."/assets/image_product/";
                $product = Product::findOrFail($request->vnp_TxnRef);
                foreach($product->ProductImages()->get() as $image){
                    if(file_exists($path.$image->image)){
                        unlink($path.$image->image);
                    }
                }
                $product->delete();
            }
        }
        return view($this->module.'.product.create_product');
    }
}
