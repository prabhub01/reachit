<?php

namespace App\Http\Middleware;

use Closure;

class LocaleSetterMiddleware
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

        // dd(request()->path());
        // $isAdmin =url()->full();
        // if(request()->segment(1) == 'admin'){
        //     return redirect()->away($isAdmin);
        // }

        if (session()->has('locale_code')) {
            app()->setLocale(session('locale_code'));
        }
        else {
            app()->setLocale('en');
        }

        return $next($request);

    }
}
