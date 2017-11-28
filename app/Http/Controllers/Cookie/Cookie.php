<?php
namespace App\Http\Controllers\Cookie;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    public static function setCookie($name='',$value='',$minute=0)
    {
        if(isset($name) && isset($value))
        {
            return setcookie($name,$value,$minute);
        }
        return false;

    }

    public static function getCookie($name)
    {
        return ( isset($_COOKIE[$name]) ? $_COOKIE[$name] : '' );
    }

    public static function removeCookie($name)
    {
        if(isset($_COOKIE[$name]))
        {
            unset($_COOKIE['key']);
            setcookie($name, '', time() - 3600);
            return true;
        }
        return false;
    }
}