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
      
    }
    public function Signup()
    {
        echo ( !isset($_COOKIE['login']) ? url('signup') : '');
    }

    public function Login()
    {
        $a=1;
        echo ( !isset($_COOKIE['login']) ? url('login') : '');
    }
}