<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Session\SessionController;
use App\Http\Controllers\Cookie\CookieController;
class LogoutController extends Controller
{
    public function process()
    {
        $bLogout = ( !empty(CookieController::removeCookie('user_hash') ) && !empty(CookieController::removeCookie('user_id')) &&  SessionController::deleteAll()  ? true : false);
        return ($bLogout ? redirect(url('')) : back() );
    }
}