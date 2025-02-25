<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Job;
use APP\Models\Application;
use App\Policies\JobPolicy;
use App\Policies\ApplicationPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Define a Gate to check if the user is an Employer
        Gate::define('post-job', function (User $user) {
            return $user->role === 'employer';
        });

        // Define a Gate to check if the user is an Applicant
        Gate::define('apply-job', function (User $user) {
            return $user->role === 'applicant';
        });

        // Define a Policy for Job model
        Gate::define('update-status', function (User $user, Job $job) {
            return $user->role === 'employer';
        });

        // Define a Policy for Job model
        Gate::define('get-status', function (User $user, Job $job) {
            return $user->role === 'employer';
        });
    }
}
