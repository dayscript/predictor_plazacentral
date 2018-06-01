<?php

namespace App\Http\Controllers;

use App\Predictor\GroupPrediction;

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
}
