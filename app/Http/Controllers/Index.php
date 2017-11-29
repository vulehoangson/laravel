<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\LoginController;
class IndexController extends Controller
{
    public function __construct()
    {

    }

    public function process()
    {
        $oUser=new LoginController();
        $bLogin=$oUser->checkAutoLogin();
        return view('index',['bLogin' => $bLogin]);
    }
}