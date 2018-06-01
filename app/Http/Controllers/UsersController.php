<?php

namespace App\Http\Controllers;

use App\Predictor\Group;
use App\Predictor\GroupPrediction;

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
     * Adds prediction
     * @param Group $group
     * @return array
     */
    public function addGroupPrediction(Group $group)
    {
        $results    = [];
        $prediction = GroupPrediction::firstOrCreate(['user_id' => auth()->user()->id, 'group_id' => $group->id]);
        if ($first = request()->get('first')) $prediction->first_team_id = $first;
        if ($second = request()->get('second')) $prediction->second_team_id = $second;
        $prediction->save();
        $results['first']      = $first;
        $results['prediction'] = $prediction;
        $results['group']      = $group;
        $results['message']    = __('predictions.predictions_updated');
        $results['status']     = 'success';
        return $results;

    }
}
