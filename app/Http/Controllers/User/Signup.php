<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Cookie\CookieController;
use App\User\SignupModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SignupController extends Controller
{
    public function __construct()
    {

    }
    public function openFormSignup()
    {
        if(!isset($_COOKIE['login']))
        {
            return view('Signup');
        }
    }
    public function validateSignup(Request $request)
    {
        $all=$request->all();
        $username=$all['username'];
        $password=$all['password'];
        if(!empty($username) && !empty($password))
        {
            $oModel=new SignupModel($username,$password);
            $iId=$oModel->Signup();
            if($iId)
            {
                CookieController::setCookie('login','success',time() + (10 * 365 * 24 * 60 * 60));
                CookieController::setCookie('user_id',$iId,time() + (10 * 365 * 24 * 60 * 60));
                return redirect(url(''));
            }
        }
    }
}