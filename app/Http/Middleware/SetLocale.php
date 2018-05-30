<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $lang = config('app.locale');
        $user = auth()->user();
        if ($request->has('lang') && $request->get('lang')) {
            $lang = $request->get('lang');
        } else if ($user && $user->lang) {
            $lang = $user->lang;
        } else if (session()->exists('locale') && session()->get('locale')) {
            $lang = session()->get('locale');
        } else {
            $lang = getBrowserLocale(['es', 'en']);
        }
        session()->put('locale', $lang);
        if($user){
            $user->lang = $lang;
            $user->save();
        }
        app()->setLocale($lang);
        return $next($request);
    }
}
