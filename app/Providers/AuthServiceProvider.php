<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\Employee;
use App\Policies\CompanyPolicy;
use App\Policies\EmployeePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Company::class => CompanyPolicy::class,
        Employee::class => EmployeePolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::guessPolicyNamesUsing(function ($modelClass) {
            return '\\App\\Policies\\' . class_basename($modelClass) . 'Policy';
        });
    }
}
