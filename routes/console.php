<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('matches:create', function () {
    $round1 = \App\Predictor\Round::firstOrCreate(['name'=>'group_phase']);
    $round2 = \App\Predictor\Round::firstOrCreate(['name'=>'round_of_16']);
    $round3 = \App\Predictor\Round::firstOrCreate(['name'=>'quarter_finals']);
    $round4 = \App\Predictor\Round::firstOrCreate(['name'=>'semi_finals']);
    $round5 = \App\Predictor\Round::firstOrCreate(['name'=>'finals']);
    $ids = [958022,958023,958028,958029,958034,958041,958035,958040,958047,958057,958046,958056,958058,958059,958069,958068,958024,958031,958025,958030,958037,958036,958042,958049,958043,958048,958060,958054,958055,958061,958066,958067,958027,958026,958033,958032,958039,958038,958045,958044,958053,958052,958051,958050,958065,958064,958063,958062,958070,958071,958072,958073,958075,958074,958077,958076,958078,958079,958081,958080,958082,958083,958084,958085];
//    $ids = [958070,958071,958072,958073,958075,958074,958077,958076,958078,958079,958081,958080,958082,958083,958084,958085];
    foreach($ids as $key=>$id){
        $match = \App\Predictor\Match::firstOrCreate(['id'=>$id]);
        if($match->id<=958069)$match->round_id= $round1->id;
        else if(in_array($match->id,[958084,958085]))$match->round_id= $round5->id;
        else if(in_array($match->id,[958082,958083]))$match->round_id= $round4->id;
        else if(in_array($match->id,[958078,958079,958080,958081]))$match->round_id= $round3->id;
        else if(in_array($match->id,[958070,958071,958075,958074,958072,958073,958077,958076]))$match->round_id= $round2->id;
        $this->info($key+1 . ' Match: '.$match->id);
//        $match->channel = '600dtsc';
        $match->updateOptaData();
        $match->updateGroup();
//        $week = $match->when->weekOfYear;
//        $week_name = 'Semana '.$week;
//        $start = $match->when->startOfWeek();
//        $end = $match->when->endOfWeek();
//        $this->info($week_name . ': ' . $start . ' - ' . $end);
//        $round = \App\Round::firstOrCreate(['name'=>$week_name]);
//        $round->start = $start;
//        $round->end = $end;
//        $round->save();
//        $match->roundId()->associate($round);
//        $match->save();
    }
})->describe('Creates tournament matches');
