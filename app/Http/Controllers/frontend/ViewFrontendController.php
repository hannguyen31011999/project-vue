<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\ProductImage;
use App\Model\Order;
use App\Model\Categories;
use App\Model\Post;
use App\Model\Slug;
use App\Model\Visitor;
use Mail;
use Session;
class ViewFrontendController extends Controller
{
    private $module = 'frontend';

    public function __construct(Request $request)
    {
        if($request->ip()!=''){
            Visitor::create(['ip'=>$request->ip()]);
        }
    }
    public function viewIndex()
    {
        
        return view($this->module.'.home.index_home');
    }

    public function viewPostDetail($url)
    {
        $post = Post::where('url','like','%'.$url.'%')->first();
        if($post!=null){
            return view($this->module.'.post.detail_post');
        }else{
            return view($this->module.'.errors.page_404');
        }
        
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
                    'code'=>randomCode(9).$product->id
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

    public function listProduct($url)
    {
        $categories = Categories::where('url','like','%'.$url.'%')->first();
        if($categories!=null){
            return view($this->module.'.product.list_product');
        }else{
            return view($this->module.'.errors.page_404');
        }
    }

    public function detailProduct($url)
    {
        $slug = Slug::where('url','like','%'.$url.'%')->first();
        if($slug!=null){
            return view($this->module.'.product.detail_product');
        }else{
            return view($this->module.'.errors.page_404');
        }
    }

    public function viewSeachOrder()
    {
        return view($this->module.'.seach.seach_order');
    }
}
