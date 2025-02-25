<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\User;
use App\Models\Job;

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
        Gate::define('create-job', function (User $user) {
            return $user->role === 'employer';
        });

        Gate::define('apply-job', function (User $user) {
            return $user->role === 'applicant';
        });

        Gate::define('update-status', function (User $user) {
            return $user->role === 'employer';
        });

        // Define a Policy for Job model
        Gate::define('get-applications', function (User $user) {
            return $user->role === 'employer';
        });
    }
}
