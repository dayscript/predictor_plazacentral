<?php

namespace App\Http\Controllers;

use App\User;
use App\Predictor\League;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Notifications\LeagueInviteNotification;

class LeaguesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'locale']);
    }

    /**
     * Leagues page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $option    = 'list';
        $leagues = auth()->user()->leagues()->withCount('users')->get()->each->append('users_points');
        return view('pages.leagues', compact('leagues', 'option'));
    }

    /**
     * @param $code
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function join($code)
    {
        $option = 'join';
        $leagues = auth()->user()->leagues()->withCount('users')->get()->each->append('users_points');
        return view('pages.leagues', compact('leagues', 'code', 'option'));
    }

    /**
     * Join league
     * @return array
     */
    public function joinLeague()
    {
        $results = [];
        if ($code = request()->get('code')) {
            if ($league = League::where('code', $code)->first()) {
                $league->users()->detach(auth()->user()->id);
                $league->users()->attach(auth()->user()->id);
                $results['status'] = 'success';
                $results['message'] = __('leagues.you_have_joined');
            } else {
                $results['status'] = 'error';
                $results['message'] = __('leagues.league_code_not_found');
            }
        } else {
            $results['status'] = 'error';
            $results['message'] = __('leagues.league_code_not_found');
        }
        return $results;
    }

    /**
     * Displays creation form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $option  = 'create';
        $leagues = auth()->user()->leagues()->withCount('users')->get()->each->append('users_points');
        return view('pages.leagues', compact('option', 'leagues'));
    }

    /**
     * Displays edit form
     * @param League $league
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(League $league)
    {
        $edit_league = $league;
        $option      = 'edit';
        $leagues     = auth()->user()->leagues()->withCount('users')->get()->each->append('users_points');
        return view('pages.leagues', compact('option', 'edit_league', 'leagues'));
    }

    /**
     * Updates object
     * @param League $league
     * @return array
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(League $league)
    {
        $this->validate(request(), [
            'name'        => 'required|min:3',
            'description' => 'required|min:3',
            'code'        => [
                'required', 'min:5', 'alpha_num',
                Rule::unique('leagues')->ignore($league->id),
            ],
        ]);
        $this->authorize('update', $league);
        $league->update(request()->all());
        $results            = [];
        $results['status']  = 'success';
        $results['message'] = __('leagues.league_updated');

        return $results;
    }

    /**
     * Adds new league
     * @return array
     */
    public function store()
    {
        $this->validate(request(), [
            'name'        => 'required|min:3',
            'description' => 'required|min:3',
            'code'        => 'required|min:5|alpha_num|unique:leagues',
        ]);
        $results = [];
        $league  = auth()->user()->myleagues()->create(request()->all());
        auth()->user()->leagues()->detach($league->id);
        auth()->user()->leagues()->attach($league->id);
        $results['id']      = $league->id;
        $results['status']  = 'success';
        $results['message'] = __('leagues.league_created');
        return $results;
    }

    /**
     * Deletes
     * @param League $league
     * @return array
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Exception
     */
    public function destroy(League $league)
    {
        $results = [];
        $this->authorize('delete', $league);
        $league->delete();
        $results['status']  = 'success';
        $results['message'] = __('leagues.league_deleted');

        return $results;
    }

    /**
     * Invite users to given league
     * @param League $league
     * @return array
     */
    public function inviteLeague(League $league)
    {
        $results = [];
        $errors  = [];
        $success = [];
        $list    = request()->get('list');
        $list    = str_replace('\r\n', ',', $list);
        $list    = str_replace('\n', ',', $list);
        $list    = str_replace('\r', ',', $list);
        $list    = str_replace(' ', '', $list);
        $list    = str_replace('
', ',', $list);
        if ($list != "") {
            $emails = explode(',', $list);
            foreach ($emails as $email) {
                $email     = strtolower(trim($email));
                $validator = Validator::make(['email' => $email], [
                    'email' => 'required|email',
                ]);
                if ($validator->fails()) {
                    $errors[] = $email;
                } else {
                    $success[] = $email;
                    $password  = false;
                    if (!($us = User::where('email', $email)->first())) {
                        $name     = substr($email, 0, strpos($email, '@'));
                        $password = $name . rand(1000, 9999);
                        $us       = User::create([
                            'email'    => $email,
                            'name'     => $name,
                            'password' => bcrypt($password)
                        ]);
                    }
//                    $us->leagues()->detach($league->id);
//                    $us->leagues()->attach($league->id);
                    $us->notify(new LeagueInviteNotification($league, $password));
                }
            }
        }
        $results['errors']  = $errors;
        $results['success'] = $success;
        $results['status']  = 'success';
        $results['message'] = count($success) . ' invitaciones enviadas';
        return $results;
    }

    /**
     * Leave league
     * @param League $league
     * @return array
     */
    public function leaveLeague(League $league)
    {
        $results = [];
        $league->users()->detach(auth()->user()->id);
        $results['status'] = 'success';
        $results['message'] = __('leagues.league_abandoned');

        return $results;
    }
}
