<?php

namespace App\Predictor;

use App\User;
use Illuminate\Database\Eloquent\Model;

class MatchPrediction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','match_id'];
    /**
     * Match relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function match()
    {
        return $this->belongsTo(Match::class);
    }
    /**
     * User relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Update points
     */
    public function updatePoints()
    {
        $match = $this->match;
        $new_points = 0;
        if(!in_array($match->status,['pending','PreMatch']) && $this->local_score !== null && $this->visit_score !== null){
            if(($this->local_score == $match->local_score) && ($this->visit_score == $match->visit_score)) $new_points += 1;
            if( ($this->local_score == $this->visit_score) && ($match->local_score == $match->visit_score) ) $new_points += 2;
            elseif( ($this->local_score > $this->visit_score) && ($match->local_score > $match->visit_score) ) $new_points += 2;
            elseif( ($this->local_score < $this->visit_score) && ($match->local_score < $match->visit_score) ) $new_points += 2;
        }
        if($new_points != $this->points){
            $this->user->points += ($new_points-$this->points);
            $this->user->save();
            $this->points = $new_points;
            $this->save();
        }
    }
}
