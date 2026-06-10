<?php

namespace App\Http\Middleware;

use App\Support\LocaleRegistry;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SetLocaleFromRouteMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $locale = (string) $request->route('locale', '');

        if (! LocaleRegistry::isSupported($locale)) {
            throw new NotFoundHttpException('Locale not found.');
        }

        App::setLocale($locale);
        $request->attributes->set('current_locale', $locale);

        return $next($request);
    }
}
