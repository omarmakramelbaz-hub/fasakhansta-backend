<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckLang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
     public function handle($request, Closure $next) {
        $lang = app()->getLocale();
        if ($request->header('Lang') != null && in_array($request->header('Lang'),available_languages())) {
          $lang = $request->header('Lang');
        } elseif (auth()->check()) {
          $lang = auth()->user()->lang??app()->getLocale();
        }

        App::setLocale($lang);
        Carbon::setLocale($lang);
        $timezone = $request->header('Timezone') ?? 'Africa/Cairo';

        // Store the timezone in the application's configuration
        config(['app.timezone' => $timezone]);
        return $next($request);
    }
}
