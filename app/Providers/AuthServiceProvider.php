<?php

namespace App\Providers;

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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('master-policy.perform', 'App\Policies\Admin\MasterAccessPolicy@perform');
        Gate::define('master-policy.performArray', 'App\Policies\Admin\MasterAccessPolicy@performArray');

        $this->registerPolicies();

        //
    }
}
