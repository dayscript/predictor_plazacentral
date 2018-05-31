<?php

namespace App\Predictor;

use App\User;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','code'];
    /**
     * Owner of this league
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Users of this league
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
    /**
     * Total sum of users points
     * @return mixed
     */
    public function getUsersPointsAttribute()
    {
        return $this->users->sum('points');
    }
}
