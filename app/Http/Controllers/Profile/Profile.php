<?php
namespace App\Http\Controllers\Profile;
use App\Http\Controllers\Controller;
use App\Http\Controllers\User\LoginController;
class ProfileController extends Controller
{
    public function __construct()
    {
        
    }

    public function process($iUserId)
    {
        $oUser=new LoginController();
        $bLogin=$oUser->checkAutoLogin();
        return view('profile',[
            'bLogin' => $bLogin
        ]);
    }
}