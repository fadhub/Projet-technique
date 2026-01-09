<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));
        } else {
            // Si aucune langue n'est définie, utilisez la langue du navigateur ou la langue par défaut
            $browserLocale = $request->getPreferredLanguage(['en', 'fr']);
            App::setLocale($browserLocale ?: config('app.locale'));
        }
        
        return $next($request);
    }
}