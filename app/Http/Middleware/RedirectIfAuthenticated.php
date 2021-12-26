<?php

namespace App\Http\Middleware;

use App\Helper\SettingHelper;
use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @param null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        SettingHelper::loadOptions();
        switch ($guard) {
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('admin.dashboard');
                }
                break;
            case 'user':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('user.dashboard');
                }
                break;
            default:
                return redirect('/home');
        }
        return $next($request);
    }
}
