<?php

namespace App\Http\Controllers\Session;
use App\Http\Controllers\Controller;

session_start();

class SessionController extends Controller
{
    public static function createSession($key,$value)
    {
        if(!empty($key) && !empty($value))
        {
            $_SESSION[$key] = $value;
            return true;
        }
        return false;
    }

    public static function getSession($key)
    {
        if(!empty($_SESSION[$key]))
        {
            return $_SESSION[$key];
        }
        return false;
    }

    public static function deleteSession($key)
    {
        if(!empty($_SESSION[$key]))
        {
            unset($_SESSION[$key]);
            return true;
        }
        return false;
    }
    public static function deleteAll()
    {
        session_destroy();
        return true;
    }
}