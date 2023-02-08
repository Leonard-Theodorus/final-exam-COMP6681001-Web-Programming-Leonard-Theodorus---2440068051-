<?php

namespace App\Providers;

use App\Models\Account;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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
        Gate::define('admin', function(Account $user){
            return $user->role_id == 2;
        });
        Gate::define('unregistered', function(){
            return auth()->check();
        });
        $this->registerPolicies();

        //
    }
}
