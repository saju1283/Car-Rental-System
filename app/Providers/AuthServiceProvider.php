<?php

namespace App\Providers;

use App\Models\Rental;
use App\Policies\RentalPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // Add this line:
        Rental::class => RentalPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is-admin', fn($user) => $user->role === 'admin');
        Gate::define('is-customer', fn($user) => $user->role === 'customer');

        //
    }
}