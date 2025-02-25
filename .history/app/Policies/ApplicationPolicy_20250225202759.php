<?php

namespace App\Policies;

use App\Models\User;

class ApplicationPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function getApplicationLists(User $user)
    {
        return $user->role === 'employer';
    }

    public function applyJob(User $user)
    {
        return $user->role === 'applicant';
    }
}
