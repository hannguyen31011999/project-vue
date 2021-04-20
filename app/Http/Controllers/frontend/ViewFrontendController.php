<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

    public function viewCreateProduct()
    {
        return view($this->module.'.product.create_product');
    }
}
