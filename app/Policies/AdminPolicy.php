<?php

namespace App\Policies;

use App\User;
use App\Slide;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any slides.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function before(User $user){
        if($user->idGroup == 1){
            return true;
        }
    }
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the slide.
     *
     * @param  \App\User  $user
     * @param  \App\Slide  $slide
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->idGroup == 2;
    }

    /**
     * Determine whether the user can create slides.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->idGroup == 2;
    }

    /**
     * Determine whether the user can update the slide.
     *
     * @param  \App\User  $user
     * @param  \App\Slide  $slide
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->idGroup == 2;
    }

    /**
     * Determine whether the user can delete the slide.
     *
     * @param  \App\User  $user
     * @param  \App\Slide  $slide
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->idGroup == 2;
    }

    /**
     * Determine whether the user can restore the slide.
     *
     * @param  \App\User  $user
     * @param  \App\Slide  $slide
     * @return mixed
     */
    public function restore(User $user)
    {
        return $user->idGroup == 2;
    }

    /**
     * Determine whether the user can permanently delete the slide.
     *
     * @param  \App\User  $user
     * @param  \App\Slide  $slide
     * @return mixed
     */
    public function forceDelete(User $user)
    {
        return $user->idGroup == 2;
    }
}
