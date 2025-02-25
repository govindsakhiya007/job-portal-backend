<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;

class JobListsPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user)
    {
        return $user->role === 'employer';
    }

    public function applyJob(User $user)
    {
        return $user->role === 'applicant';
    }
}
