<?php

namespace App\Providers;

use App\Models\ConnectedAccount;
use App\Policies\ConnectedAccountPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        ConnectedAccount::class => ConnectedAccountPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
