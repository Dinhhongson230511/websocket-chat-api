<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
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
        $this->registerPolicies();

        $this->setGates();
    }

    private function setGates()
    {
        Gate::define('admin', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('agency', function (User $user) {
            return $user->isAgency();
        });

        Gate::define('company', function (User $user) {
            return $user->isCompany();
        });

        Gate::define('store', function (User $user) {
            return $user->isStore();
        });

        Gate::define('company_store', function (User $user) {
            return $user->isStore() || $user->isCompany();
        });
    }
}
