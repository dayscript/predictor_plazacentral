<?php

namespace App\Http\Controllers;

use App\Predictor\Match;
use Illuminate\Http\Request;

class MatchesController extends Controller
{
    /**
     * @param Match $match
     * @return array
     */
    public function show(Match $match)
    {
        $results = [];
        $match->load(['visitId','localId']);
        $match->visitId->append('short');
        $match->localId->append('short');
        $match->append(['myprediction']);
        $results['match'] = $match;
        return $results;
    }
}
