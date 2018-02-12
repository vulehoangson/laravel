<?php

namespace App\Http\Middleware;
use Closure;
use App;
use App\Http\Controllers\Cookie\CookieController;
class Language
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $sLanguage = CookieController::getCookie('language');
        if(!empty($sLanguage))
        {
            App::setLocale($sLanguage);
        }

        return $next($request);
    }
}
