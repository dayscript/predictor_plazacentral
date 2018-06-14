<?php

namespace App\Http\Controllers;

use App\Predictor\Group;
use App\Predictor\GroupPrediction;
use App\Predictor\League;
use App\Predictor\Round;
use App\User;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware(['auth','locale'])->except(['updateLang']);
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
    
    /**
     * Ranking data by page
     * @param int $page
     * @return array
     */
    public function ranking($page = 1)
    {
        $league = request()->get('league', 0);
        $round = request()->get('round', 0);
        $results = [];
        if($league){
            $lg = League::find($league);
            $users = $lg->users()->orderByDesc('points')->get();
        } else {
            $users = User::orderByDesc('points')->get();
        }
        $results['pagination']['total'] = $users->count();
        $results['pagination']['page'] = $page;
        $results['pagination']['items'] = 10;
        $results['pagination']['prev'] = ($page > 1 ? $page - 1 : null);
        $results['pagination']['pages'] = ceil($results['pagination']['total'] / $results['pagination']['items']);
        $results['pagination']['next'] = ($page < $results['pagination']['pages'] ? $page + 1 : null);
        if ($round) {
            $rnd = Round::find($round);
            foreach ($users as $key => $user) {
//                $users[$key]->points = $user->predictions()->whereHas('match', function ($query) use ($round) {
//                    $query->where('round_id', $round);
//                })->get()->sum('points');
                $users[$key]->points = 0;
            }
            $users = array_sort($users, function ($value) {
                return -(100 * $value->points);
            });
            $newusers = [];
            foreach ($users as $user) {
                $newusers[] = $user;
            }
            $newusers = collect($newusers);
            $newusers = $newusers->forPage($page, 10);
        } else {
            $newusers = $users->forPage($page, 10);
        }
        $results['users'] = $newusers;
        return $results;
    }
    /**
     * Displays user account page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function account()
    {
        $user = auth()->user();
        $rounds = Round::orderBy('id')->get();
        $leagues = auth()->user()->leagues;

        return view('users.account', compact('user','rounds','leagues'));
    }
    /**
     * Updates user password
     */
    public function updatePassword()
    {
        $this->validate(request(),[
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = auth()->user();
        $user->password = bcrypt(request()->get('password'));
        $user->save();
        $results = [];
        $results['status']  = 'success';
        $results['message']  = __('users.password_changed');

        return $results;

    }
    public function updateUser()
    {
        $this->validate(request(),[
            'password' => 'required|string|min:6|confirmed',
        ]);
    }
}
