<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['updateLang']);
    }

    /**
     * Update lang for current user
     *
     * @param string $lang
     * @return array
     */
    public function updateLang($lang = 'en')
    {
        $results = [];
        session()->put('locale', $lang);
        app()->setLocale($lang);
        if ($user = auth()->user()) {
            $user->lang = $lang;
            $user->save();
            $results['message'] = __('users.lang_updated');
            $results['status']  = 'success';
        } else {
            $results['message'] = __('users.not_logged_in');
            $results['status']  = 'error';
        }
        return $results;
    }
}
