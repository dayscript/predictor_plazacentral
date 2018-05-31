<?php

namespace App\Policies;

use App\Predictor\League;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeaguePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Determine whether the user can update the prediction.
     *
     * @param  \App\User $user
     * @param League $league
     * @return mixed
     */
    public function update(User $user, League $league)
    {
        return in_array($league->id, $user->myleagues->pluck('id')->toArray());
    }
    /**
     * Determine whether the user can delete the prediction.
     *
     * @param  \App\User $user
     * @param League $league
     * @return mixed
     */
    public function delete(User $user, League $league)
    {
        return in_array($league->id, $user->myleagues->pluck('id')->toArray());
    }
}
