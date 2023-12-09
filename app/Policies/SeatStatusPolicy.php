<?php

namespace App\Policies;

use App\Models\SeatStatus;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeatStatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SeatStatus  $seatStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, SeatStatus $seatStatus)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SeatStatus  $seatStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, SeatStatus $seatStatus)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SeatStatus  $seatStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, SeatStatus $seatStatus)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SeatStatus  $seatStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, SeatStatus $seatStatus)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\SeatStatus  $seatStatus
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, SeatStatus $seatStatus)
    {
        //
    }
}
