<?php

namespace App\Http\Controllers\frontend\api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Model\Province;
use App\Model\Product;
use App\Model\ProductImage;
use App\Model\Order;
use App\Model\Variant;
use App\Model\TypeProduct;
use App\Model\Categories;
use App\Model\Slug;
use Mail;
use Carbon\Carbon;
use DateTime;
class ApiCheckoutController extends Controller
{
    private $vnp_TmnCode = "EOGCBMO4"; // Mã website tại VNPAY 
    private $vnp_HashSecret = "XJGOTNOGROZCWMCRJRBIDUBFTCPMGMWD"; // Chuỗi bí mật
    private $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
    private $vnp_Returnurl = "http://localhost:8000/dang-tin-rao-ban";

    public function createOrder(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'type_id'=>'required',
                'categories_id'=>'required',
                'province_id'=>'required',
                'district_id'=>'required',
                'ward_id'=>'required',
                'title'=>'required|max:100',
                'area'=>'required|numeric',
                'price'=>'required|numeric',
                'desc'=>'required|max:3000',
                'date_start'=>'required',
                'date_end'=>'required',
                'fullname'=>'required|max:254|regex:[^[a-zA-Z]]',
                'address'=>'required|max:254',
                'address_guest'=>'required|max:254',
                'phone'=>'required|numeric|regex:/(0)[0-9]{9}/',
                'email'=>'required|max:100|email',
                'image'=>'required'
            ],
            [
                'type_id.required'=>'Vui lòng chọn loại tin',
                'categories_id.required'=>'Vui lòng chọn hình thức bán',
                'province_id.required'=>'Vui lòng chọn tỉnh/tp',
                'district_id.required'=>'Vui lòng chọn quận/huyện',
                'ward_id.required'=>'Vui lòng chọn phường/xã',
                'title.required'=>'Vui lòng nhập tiêu đề',
                'title.max'=>'Tiêu đề tối đa 100 kí tự',
                'title.regex'=>'Tiêu đề có kí tự đặc biệt',
                'area.required'=>'Vui lòng nhập diện tích',
                'area.numeric'=>'Diện tích phải là số',
                'price.required'=>'Vui lòng nhập giá tiền',
                'price.numeric'=>'Giá tiền phải là số',
                'desc.required'=>'Vui lòng nhập mô tả',
                'desc.max'=>'Mô tả tối đa 3000 kí tự',
                'date_start.required'=>'Vui lòng nhập ngày bắt đầu',
                'date_end.required'=>'Vui lòng nhập ngày kết thúc',
                'fullname.required'=>'Vui lòng nhập tên',
                'fullname.max'=>'Tên tối đa 254 kí tự',
                'fullname.regex'=>'Tên phải là chữ',
                'address.required'=>'Vui lòng nhập địa chỉ liên lạc',
                'address.max'=>'Địa chỉ tối đa 254 kí tự',
                'address_guest.required'=>'Vui lòng nhập địa chỉ',
                'address_guest.max'=>'Địa chỉ tối đa 254 kí tự',
                'phone.required'=>'Vui lòng nhập số điện thoại',
                'phone.regex'=>'Số điện thoại sai định dạng',
                'phone.numeric'=>'Số điện thoại phải là số',
                'email.email'=>'Không đúng định dạng email',
                'email.max'=>'Email quá dài',
                'email.required'=>'Vui lòng nhập email',
                'image.required'=>'Vui lòng chọn ảnh',
                'image.image'=>'Ảnh có đuôi .jpeg,png,jpg'
            ]
        );
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'data'=>null,
                'errors'=>$validator->errors(),
                'limit'=>null
            ]);
        }else{
            if($request->hasFile('image')){
                $count = 0;
                $file = $request->file('image');
                foreach($file as $files){
                    $count++;
                }
                if($count<=limitImage($request->type_id)){
                    $start = Carbon::create($request->date_start);
                    $end = Carbon::create($request->date_end);
                    $totalDate = ($end->diffInDays($start) > 1) ? $end->diffInDays($start) + 1 : 1;
                    $order = [
                        'user_id'=>!empty($request->user_id) ? $request->user_id : null,
                        'fullname'=>$request->fullname,
                        'address'=>$request->address_guest,
                        'phone'=>$request->phone,
                        'email'=>$request->email,
                        'total_date'=>$totalDate,
                        'price'=>TypeProduct::findOrFail($request->type_id)->price
                    ];
                    $input1 = [
                        'type_id'=>(int)$request->type_id,
                        'categories_id'=>(int)$request->categories_id,
                        'province_id'=>(int)$request->province_id,
                        'district_id'=>(int)$request->district_id,
                        'ward_id'=>(int)$request->ward_id,
                        'title'=>$request->title,
                        'area'=>(double)$request->area,
                        'price'=>(double)$request->price,
                        'address'=>$request->address,
                        'desc'=>$request->desc,
                        'date_start'=>$request->date_start,
                        'date_end'=>$request->date_end,
                        'status'=>0,
                    ];
                    $input2 = [
                        'facade'=>$request->facade,
                        'access_road'=>$request->access_road,
                        'direction'=>$request->direction,
                        'num_floor'=>$request->num_floor,
                        'num_bedroom'=>$request->num_bedroom,
                        'furniture'=>$request->furniture,
                        'juridical'=>$request->juridical
                    ];
                    $product = Product::create($input1);
                    $variant = $product->Variants()->create($input2);
                    $order = $product->Orders()->create($order);
                    $slug = Slug::create([
                        'categories_id'=>$request->categories_id,
                        'product_id'=>$product->id,
                        'url'=>utf8tourl($request->title)
                    ]);
                    foreach($file as $files){
                        ProductImage::create([
                            'product_id'=>$product->id,
                            'image'=>$files->getClientOriginalName()
                        ]);
                        $files->move('assets/image_product',$files->getClientOriginalName());
                    }
                    // $mail = [
                    //     'email'=>$request->email,
                    //     'code'=>$product->id
                    // ];
                    // Mail::send('frontend.mail.checkout_mail',$mail,
                    //     function($messenger) use ($mail){
                    //         $messenger->to($mail["email"],'Hệ thống')->subject('[Bất động sản Quận 9] Đơn hàng của bạn?');
                    // });
                }else{
                    return response()->json([
                        'status'=>false,
                        'data'=>null,
                        'errors'=>null,
                        'limit'=>'Tối đa '.limitImage($request->type_id)
                    ]);
                }
            }
            //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_TxnRef = $product->id;
            $vnp_OrderInfo = "Thanh toán tiền đăng tin Bất Động Sản Quận 9";
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $order['price'] * $order['total_date'] * 100;
            $vnp_Locale = 'vn';
            $vnp_IpAddr = request()->ip();
            $inputData = array(
                "vnp_Version" => "2.0.0",
                "vnp_TmnCode" => $this->vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount + ($vnp_Amount/100*10),
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $this->vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . $key . "=" . $value;
                } else {
                    $hashdata .= $key . "=" . $value;
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }
            $this->vnp_Url = $this->vnp_Url . "?" . $query;
            if (isset($this->vnp_HashSecret)) {
                $vnpSecureHash = hash('sha256', $this->vnp_HashSecret . $hashdata);
                $this->vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
            }
            return response()->json([
                'status'=>true,
                'data'=>$this->vnp_Url,
                'errors'=>null,
                'limit'=>null
            ]);
        }
    }
}
