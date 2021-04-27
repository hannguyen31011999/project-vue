<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
class ViewController extends Controller
{
    private $module = 'backend';
    
    public function viewLogin(Request $request)
    {
        return view($this->module.'.login.index');
    }

    public function viewDashBoard(Request $request)
    {
        return view($this->module.'.dashboard.index');
    }

    public function viewCategories()
    {
        return view($this->module.'.categories.index_cate');
    }

    public function viewTypeProduct()
    {
        return view('backend.type_product.index_type');
    }

    public function viewUser()
    {
        return view('backend.user.index_user');
    }

    public function viewProvince()
    {
        return view('backend.province.index_province');
    }

    public function viewDistrict()
    {
        return view('backend.district.index_district');
    }

    public function viewWard()
    {
        return view('backend.ward.index_ward');
    }

    public function viewPost()
    {
        return view('backend.post.index_post');
    }

    public function viewProduct()
    {
        return view('backend.product.index_product');
    }

    public function viewImage()
    {
        return view('backend.image.index_image');
    }

    public function viewOrder()
    {
        return view('backend.order.index_order');
    }

}
