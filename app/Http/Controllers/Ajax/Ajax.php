<?php
namespace App\Http\Controllers\Ajax;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Cookie\CookieController;
use App\User\LoginModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Session\SessionController;
class AjaxController extends Controller
{
    public function __construct()
    {

    }

    public function Logout()
    {
        echo ( !empty(CookieController::removeCookie('user_hash') ) && !empty(CookieController::removeCookie('user_id') &&  SessionController::deleteAll() ) ? url('') : ''   );
    }
    public function Signup()
    {
        echo ( !isset($_COOKIE['login']) ? url('signup') : '');
    }

    public function Login()
    {
        echo ( !isset($_COOKIE['login']) ? url('login') : '');
    }
}