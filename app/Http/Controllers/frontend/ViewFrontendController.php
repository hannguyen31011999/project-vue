<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\ProductImage;
use App\Model\Order;
use Mail;
use Session;
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
                $product = Product::findOrFail($request->vnp_TxnRef);
                $order = $product->Orders()->get();
                $product->update(['status'=>1]);
                $mail = [
                    'email'=>$order[0]->email,
                    'mess'=>'Thanh toán thành công',
                    'code'=>$product->id
                ];
                Mail::send('frontend.mail.checkout_response',$mail,
                    function($messenger) use ($mail){
                        $messenger->to($mail["email"],'Hệ thống')->subject('[Bất động sản Quận 9] Đơn hàng của bạn?');
                });
                return redirect('/dang-tin-rao-ban');
            }else if($request->vnp_ResponseCode=='24'){
                $path = public_path()."/assets/image_product/";
                $product = Product::findOrFail($request->vnp_TxnRef);
                foreach($product->ProductImages()->get() as $image){
                    if(file_exists($path.$image->image)){
                        unlink($path.$image->image);
                    }
                }
                $order = $product->Orders()->get();
                $mail = [
                    'email'=>$order[0]->email,
                    'mess'=>'Thanh toán thất bại',
                    'code'=>$product->id
                ];
                Mail::send('frontend.mail.checkout_response',$mail,
                    function($messenger) use ($mail){
                        $messenger->to($mail["email"],'Hệ thống')->subject('[Bất động sản Quận 9] Đơn hàng của bạn?');
                });
            }
        }
        return view($this->module.'.product.create_product');
    }

    public function listProduct()
    {
        return view($this->module.'.product.list_product');
    }
}
