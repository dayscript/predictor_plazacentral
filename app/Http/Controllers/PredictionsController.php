<?php

namespace App\Http\Controllers;

use App\Predictor\Group;
use App\Predictor\GroupPrediction;
use App\Predictor\Match;
use App\Predictor\MatchPrediction;
use Carbon\Carbon;

class PredictionsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('locale');
    }

    /**
     * @param GroupPrediction $prediction
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(GroupPrediction $prediction)
    {
        return view('predictions.show', compact('prediction'));
    }

    /**
     * @param MatchPrediction $prediction
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function matchShow(MatchPrediction $prediction)
    {
        return view('predictions.match_show', compact('prediction'));
    }

    /**
     * Adds prediction
     * @param Group $group
     * @return array
     */
    public function addGroupPrediction(Group $group)
    {
        $results    = [];
        $match =  Match::find(958026);
        if($match->carbon_date->subMinutes(15) <= Carbon::now()){
            $results['message'] = 'Error';
            $results['status'] = 'error';
            return $results;
        }
        $prediction = GroupPrediction::firstOrCreate(['user_id' => auth()->user()->id, 'group_id' => $group->id]);
        if ($first = request()->get('first')) $prediction->first_team_id = $first;
        if ($second = request()->get('second')) $prediction->second_team_id = $second;
        $prediction->save();
        $prediction->updatePoints();
        $points                  = $prediction->user->points;
        $results['first']        = $first;
        $results['prediction']   = $prediction;
        $results['total_points'] = $points;
        $results['group']        = $group;
        $results['message']      = __('predictions.predictions_updated');
        $results['status']       = 'success';
        return $results;
    }

    /**
     * Adds prediction
     * @param Match $match
     * @return array
     */
    public function addMatchPrediction(Match $match)
    {
        $results    = [];
        if($match->carbon_date->subMinutes(15) <= Carbon::now()){
            $results['message'] = 'Error';
            $results['status'] = 'error';
            return $results;
        }
        
        $prediction = MatchPrediction::firstOrCreate(['user_id' => auth()->user()->id, 'match_id' => $match->id]);
        if (request()->has('local_score')) $prediction->local_score = request()->get('local_score');
        if (request()->has('visit_score')) $prediction->visit_score = request()->get('visit_score');
        $prediction->save();
        $results['prediction'] = $prediction;
        $results['match']      = $match;
        $results['message']    = __('predictions.predictions_updated');
        $results['status']     = 'success';
        return $results;
    }

    /**
     * Updates points in predictions
     */
    public function updateGroupPoints()
    {
        $predictions = GroupPrediction::all();
        foreach ($predictions as $prediction) {
            $prediction->updatePoints();
        }
    }
}
