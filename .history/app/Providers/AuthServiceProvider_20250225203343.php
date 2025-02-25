<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Job;
use APP
use App\Policies\JobPolicy;
use App\Policies\ApplicationPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        'App\Models\Job' => 'App\Policies\JobPolicy'
        'App\Models\Job' => 'App\Policies\JobPolicy'
    ];


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
        //
    }
}
