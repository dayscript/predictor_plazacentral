<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Predictor\Group;
use App\Predictor\Match;

class MatchesController extends Controller
{
    /**
     * @param Match $match
     * @return array
     */
    public function show(Match $match)
    {
        $results = [];
        $match->load(['visitId', 'localId']);
        $match->visitId->append('short');
        $match->localId->append('short');
        $match->append(['myprediction', 'active']);
        $results['match'] = $match;
        return $results;
    }

    /**
     * @return mixed
     */
    public function updateGroupPositions()
    {
        $client       = new Client();
        $url          = 'https://winsports.dayscript.com/phases/237/generate-stats';
        $res          = $client->get($url);
        $content      = $res->getBody();
        $json_content = json_decode($content);
        foreach ($json_content->groups as $key => $positions) {
            $group = Group::firstOrCreate(['name' => $key]);
            $changed = false;
            if (isset($positions[0]) && $json_content->teams->{$positions[0]}->pj) {
                if($group->first_team_id != $positions[0]){
                    $group->first_team_id = $positions[0];
                    $changed = true;
                }
                if (isset($positions[1]) ) {
                    if($group->second_team_id != $positions[1]){
                        $group->second_team_id = $positions[1];
                        $changed = true;
                    }
                }
            }
            if($changed) {
                $group->save();
                $group->updatePredictionsPoints();
            }
        }
    }
}
