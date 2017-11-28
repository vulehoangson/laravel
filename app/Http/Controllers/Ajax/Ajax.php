<?php
namespace App\Http\Controllers\Ajax;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Cookie\CookieController;
use App\User\LoginModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class AjaxController extends Controller
{
    public function __construct()
    {

    }

    public function Logout()
    {
        echo ( !empty(CookieController::removeCookie('login') ) && !empty(CookieController::removeCookie('user_id') ) ? url('') : ''   );
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