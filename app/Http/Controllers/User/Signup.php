<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Cookie\CookieController;
use App\User\SignupModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Session\SessionController;
use App\Http\Controllers\User\LoginController;
class SignupController extends Controller
{
    private $CookiesId='user_id';

    public function __construct()
    {

    }
    public function openFormSignup()
    {
        $oLogin=new LoginController();
        return ( $oLogin->checkAutoLogin() ? redirect(url('')) : view('Signup') );
    }
    public function validateSignup(Request $request)
    {
        $all=$request->all();
        $username=$all['username'];
        $password=$all['password'];
        if(!empty($username) && !empty($password))
        {
            $aInsert=array(
                'username' => $username,
                'password' => $password
            );
            $oModel=new SignupModel($aInsert);
            $iId = $oModel->Signup();
            if($iId)
            {
                SessionController::createSession($this->CookiesId,$iId);
                return redirect(url(''));
            }
            else
            {
                return view('Signup',['error' => 'Sign Up Failed. Username existed !!!']);
            }
        }
    }
}