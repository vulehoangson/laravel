<?php
namespace App\Http\Controllers\AdminCP;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function process()
    {
        return view('admincp.index',[]);
    }
}