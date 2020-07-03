<?php

namespace App\Policies;

use App\User;
use App\Station;
use Illuminate\Auth\Access\HandlesAuthorization;

class StationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the station.
     *
     * @param  \App\User  $user
     * @param  \App\Station  $station
     * @return mixed
     */
    public function view(User $user, Station $station)
    {
        // Update $user authorization to view $station here.
        return true;
    }

    /**
     * Determine whether the user can create station.
     *
     * @param  \App\User  $user
     * @param  \App\Station  $station
     * @return mixed
     */
    public function create(User $user, Station $station)
    {
        // Update $user authorization to create $station here.
        return true;
    }

    /**
     * Determine whether the user can update the station.
     *
     * @param  \App\User  $user
     * @param  \App\Station  $station
     * @return mixed
     */
    public function update(User $user, Station $station)
    {
        // Update $user authorization to update $station here.
        return true;
    }

    /**
     * Determine whether the user can delete the station.
     *
     * @param  \App\User  $user
     * @param  \App\Station  $station
     * @return mixed
     */
    public function delete(User $user, Station $station)
    {
        // Update $user authorization to delete $station here.
        return true;
    }
}
