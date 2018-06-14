<?php

namespace App\Predictor;

use App\User;
use Illuminate\Database\Eloquent\Model;

class GroupPrediction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id','group_id'];

    /**
     * Group relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
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
        $group = $this->group;
        $new_points = 0;
        if($this->first_team_id && $group->first_team_id && ($group->first_team_id == $this->first_team_id)) $new_points += 3;
        if($this->second_team_id && $group->second_team_id && ($group->second_team_id == $this->second_team_id)) $new_points += 3;
        if($new_points != $this->points){
            $this->user->points += ($new_points-$this->points);
            $this->user->save();
            $this->points = $new_points;
            $this->save();
        }
    }
}
