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
}
