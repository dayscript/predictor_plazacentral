<?php

namespace App\Predictor;

use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['teams'];
    /**
     * Teams list
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class)->withPivot('order')->withTimestamps();
    }

    /**
     * Loads predictions
     * @return array
     */
    public function getMypredictionAttribute()
    {
        return GroupPrediction::firstOrCreate(['user_id' => auth()->user()->id, 'group_id' => $this->id]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function predictions()
    {
        return $this->hasMany(GroupPrediction::class);
    }

    /**
     * Updates all predictions points
     */
    public function updatePredictionsPoints()
    {
        foreach($this->predictions as $prediction){
            $prediction->updatePoints();
        }
    }


}
