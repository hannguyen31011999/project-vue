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
}
