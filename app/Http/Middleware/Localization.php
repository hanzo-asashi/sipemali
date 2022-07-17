<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // available language in template array
        $availLocale = ['en' => 'en', 'id' => 'id'];

        // Locale is enabled and allowed to be change
        if (session()->has('lang') && array_key_exists(session()->get('lang'), $availLocale)) {
//        if (session()->has('lang')) {
            App::setLocale(session()->get('lang'));
        }

        return $next($request);
    }
}
