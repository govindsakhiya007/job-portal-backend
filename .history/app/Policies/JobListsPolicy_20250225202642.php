<?php

namespace App\Policies;

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

    public function getJobLists(User $user)
    {
        return $user->role === 'employer';
    }

	public function create(User $user)
    {
        return $user->role === 'employer';
    }

	public function updateStatus(User $user)
    {
        return $user->role === 'employer';
    }
}
