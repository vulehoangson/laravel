<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Cookie\CookieController;
use App\User\LoginModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    public function login($username='',$password='')
    {
        $bLogin=LoginModel::login($username,$password);
        return view('Login',['bLogin' => $bLogin]);
    }

    public function openFormLogin()
    {
        if(isset($_COOKIE['login']))
        {
            return redirect(url(''));
        }
        return view('Login',[]);
    }
    
    public function validateLogin(Request $request)
    {
        $all = $request->all();
        $username = $request->username;
        $password = $request->password;
        $login = new LoginModel($username, $password);
        $result = $login->Login();
        if (!empty($result)) {
            CookieController::setCookie('login', 'success', time() + (10 * 365 * 24 * 60 * 60));
            CookieController::setCookie('user_id',$result['user_id'], time() + (10 * 365 * 24 * 60 * 60));
            return redirect(url(''));
        } else
        {
            return view('Login',['error' => 'Login Failed']);
        }
    }
}
