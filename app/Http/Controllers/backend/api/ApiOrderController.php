<?php

namespace App\Http\Controllers\backend\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Model\Order;
class ApiOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  http://localhost:8000/api/admin/order/list
    public function index()
    {
        $order = Order::paginate(10);
        return response()->json([
            'status'=>true,
            'data'=>$order,
            'errors'=>null
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //  http://localhost:8000/api/admin/order/update/27?fullname=anh sơn
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),
            [
                'fullname'=>'required|max:254',
                'address'=>'required|max:254',
                'phone'=>'required|regex:/(0)[0-9]{9}/',
                'email'=>'required|email|max:100'
            ],
            [
                'fullname.required'=>'fullname is invalid',
                'fullname.max'=>'maximum 254 character',
                'address.required'=>'address is invalid',
                'address.max'=>'maximum 254 character',
                'phone.required'=>'phone is invalid',
                'phone.regex'=>'phone start number 0 and maximum 10 number',
                'email.required'=>'email is invalid',
                'email.email'=>'email wrong format',
                'email.max'=>'maximum 100 character'
            ]
        );
        if($validator->fails()){
            return response()->json([
                'status'=>false,
                'data'=>null,
                'errors'=>$validator->errors()
            ]);
        }else{
            $order = Order::findOrFail($id);
            if($order->update($request->all())){
                return response()->json([
                    'status'=>true,
                    'data'=>$order,
                    'errors'=>null
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // http://localhost:8000/api/admin/order/seach?keyword=32
    public function seach(Request $request)
    {
        $result = Order::where('id','=',$request->keyword)
                        ->orWhere('fullname','like','%'.$request->keyword.'%')
                        ->orWhere('phone','like','%'.$request->keyword.'%')
                        ->orWhere('email','like','%'.$request->keyword.'%')
                        ->take(5)
                        ->get();
        return response()->json([
            'status'=>true,
            'data'=>$result,
            'errors'=>null
        ]);
    }
}
