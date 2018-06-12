<?php

namespace App\Http\Controllers;

use App\Predictor\Match;
use Image;
use App\Predictor\Team;
use App\Predictor\Group;

class ImagesController extends Controller
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
     * @param Group $group
     * @param Team $team1
     * @param Team $team2
     * @return mixed
     */
    public function groupPrediction(Group $group, Team $team1, Team $team2)
    {
        //$blue   = '#35348f';
        $blue   = '#fff';

        $img = Image::canvas(600, 315);
        $img->fill(public_path('img/predictor-social español.jpg'));

        $img->insert('storage/'.$team1->image, 'top-left',80,100);
        $img->insert('storage/'.$team2->image, 'top-left',370,100);
        $img->rectangle(0,0,600,15, function ($draw)use($blue) {
            $draw->background($blue);
        });
        $img->text(__('predictions.group_'.$group->name), 300, 60, function ($font)use($blue) {
            $font->file(public_path('fonts/Exo2/Exo2-ExtraLight.otf'));
            $font->size(30);
            $font->color($blue);
            $font->align('center');
            $font->valign('bottom');
        });
        $img->text(__('predictions.first_place'), 160, 110, function ($font) {
            $font->file(public_path('fonts/Exo2/Exo2-Medium.otf'));
            $font->size(30);
            $font->color('#000');
            $font->align('center');
            $font->valign('bottom');
        });
        $img->text(__('predictions.second_place'), 450, 110, function ($font) {
            $font->file(public_path('fonts/Exo2/Exo2-Medium.otf'));
            $font->size(30);
            $font->color('#000');
            $font->align('center');
            $font->valign('bottom');
        });
        $img->text(__('teams.'.str_slug($team1->short)), 160, 270, function ($font) {
            $font->file(public_path('fonts/Exo2/Exo2-Light.otf'));
            $font->size(30);
            $font->color('#000');
            $font->align('center');
            $font->valign('bottom');
        });
        $img->text(__('teams.'.str_slug($team2->short)), 450, 270, function ($font) {
            $font->file(public_path('fonts/Exo2/Exo2-Light.otf'));
            $font->size(30);
            $font->color('#000');
            $font->align('center');
            $font->valign('bottom');
        });
        return $img->response('png');
    }

    /**
     * @param Match $match
     * @param $local_score
     * @param $visit_score
     * @return mixed
     */
    public function matchPrediction(Match $match, $local_score, $visit_score)
    {
        $blue   = '#35348f';
        $white   = '#fff';

        $img = Image::canvas(600, 315);
        $img->fill(public_path('img/predictor-social español.jpg'));
        if($match->localId && $match->localId->image)$img->insert('storage/'.$match->localId->image, 'top-left',80,100);
        else $img->insert('img/flag-default.png', 'top-left',80,100);
        if($match->visitId && $match->visitId->image)$img->insert('storage/'.$match->visitId->image, 'top-left',370,100);
        else $img->insert('img/flag-default.png', 'top-left',370,100);
        $img->rectangle(0,0,600,15, function ($draw)use($white) {
            $draw->background($white);
        });
        $img->text($match->date, 300, 60, function ($font)use($white) {
            $font->file(public_path('fonts/Exo2/Exo2-ExtraLight.otf'));
            $font->size(30);
            $font->color($white);
            $font->align('center');
            $font->valign('bottom');
        });
        $img->text($local_score . '   -   ' . $visit_score, 300, 180, function ($font) {
            $font->file(public_path('fonts/Exo2/Exo2-ExtraBold.otf'));
            $font->size(35);
            $font->color($white);
            $font->align('center');
            $font->valign('bottom');
        });
        $img->text(__('teams.'.str_slug($match->localId->short)), 160, 270, function ($font) {
            $font->file(public_path('fonts/Exo2/Exo2-Light.otf'));
            $font->size(20);
            $font->color($white);
            $font->align('center');
            $font->valign('bottom');
        });
        $img->text(__('teams.'.str_slug($match->visitId->short)), 450, 270, function ($font) {
            $font->file(public_path('fonts/Exo2/Exo2-Light.otf'));
            $font->size(20);
            $font->color($white);
            $font->align('center');
            $font->valign('bottom');
        });
        return $img->response('png');
    }

    /**
     * @param Match $match
     * @param $local_score
     * @param $visit_score
     * @return mixed
     */
    public function matchPredictionDev()
    {
        $blue   = '#35348f';
        $img = Image::canvas(600, 315);
        $img->fill(public_path('img/predictor-social español.jpg'));
        return $img->response('png');
    }
}
