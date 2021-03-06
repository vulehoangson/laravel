<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Cookie\CookieController;
use App\User\LoginModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User\UserModel;
use App\Http\Controllers\Session\SessionController;
class LoginController extends Controller
{
    private $oUserModel;
    private $CookiesId='user_id';
    private $CookiesHash = 'user_hash';
    public function __construct()
    {
        $this->oUserModel=new UserModel();
    }

    public function login($username='',$password='')
    {
        $bLogin=LoginModel::login($username,$password);
        return view('Login',['bLogin' => $bLogin]);
    }

    public function openFormLogin()
    {
        return ( $this->checkAutoLogin() ? redirect(url('')) : view('Login',[]) );
    }
    
    public function validateLogin(Request $request)
    {
        
        $username = $request->username;
        $password = $request->password;
        $remember = $request->remember;
        $login = new LoginModel($username, $password);
        list($iId,$password_hash) = $login->Login();
        if (!empty($iId)) {
            if(!empty($remember))
            {
                SessionController::createSession($this->CookiesId,$iId);
                CookieController::setCookie($this->CookiesHash,$password_hash,time() + (365 * 24 * 60 * 60));
                CookieController::setCookie($this->CookiesId,$iId,time() + (365 * 24 * 60 * 60));
            }
            else
            {
                SessionController::createSession($this->CookiesId,$iId);
            }

            return redirect(url(''));
        } else
        {
            return view('Login',['error' => 'Đăng nhập thất bại. Kiểm tra lại Username và Password']);
        }
    }
    public function checkAutoLogin($bGetUserGroup = false)
    {
        $user_id= 0;
        $user_hash = '';
        if(!$user_id=SessionController::getSession($this->CookiesId))
        {
            $user_hash = !empty($_COOKIE['user_hash']) ? $_COOKIE['user_hash'] : '' ;
            $user_id = !empty($_COOKIE['user_id'] ) ? $_COOKIE['user_id'] : 0;
        }

        $aUser=$this->oUserModel->getUserInfo($user_id);
        if(!empty($aUser))
        {
            return ( $bGetUserGroup ? array((!empty($user_hash) ? ($user_hash === $aUser['password'] ? true : false) : true ),$aUser['group_id']) : (!empty($user_hash) ? ($user_hash === $aUser['password'] ? true : false) : false ) );
        }
        return ($bGetUserGroup ? array(false, false) : false);

    }
    public function getCurrentUserId()
    {
        $user_id = 0;
        if(!$user_id=SessionController::getSession($this->CookiesId))
        {

            $user_id = !empty($_COOKIE['user_id'] ) ? $_COOKIE['user_id'] : 0;
        }
        return (int)$user_id;
    }
}
