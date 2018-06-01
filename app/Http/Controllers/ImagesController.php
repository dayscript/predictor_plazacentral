<?php

namespace App\Http\Controllers;

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
    
    public function groupPrediction(Group $group, Team $team1, Team $team2)
    {
        $blue   = '#35348f';
        $img = Image::canvas(600, 315,'#eee');
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
        $img->text(__('teams.'.str_slug($team1->name)), 160, 270, function ($font) {
            $font->file(public_path('fonts/Exo2/Exo2-Light.otf'));
            $font->size(30);
            $font->color('#000');
            $font->align('center');
            $font->valign('bottom');
        });
        $img->text(__('teams.'.str_slug($team2->name)), 450, 270, function ($font) {
            $font->file(public_path('fonts/Exo2/Exo2-Light.otf'));
            $font->size(30);
            $font->color('#000');
            $font->align('center');
            $font->valign('bottom');
        });
        return $img->response('png');
    }
}
