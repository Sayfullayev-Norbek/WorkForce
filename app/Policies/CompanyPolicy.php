<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\Admin;

class CompanyPolicy
{
    public function viewAny($user): bool
    {
        if ($user instanceof Admin) {
            return $user->hasPermissionTo('company:view-any', 'admin');
        }

        if ($user instanceof Company) {
            return $user->hasPermissionTo('company:view-any', 'company');
        }

        return false;
    }

    public function view($user, Company $company): bool
    {
        if ($user instanceof Admin) {
            return $user->hasPermissionTo('company:view', 'admin');
        }

        if ($user instanceof Company) {
            return $user->hasPermissionTo('company:view', 'company') && $user->id === $company->id;
        }

        return false;
    }

    public function create($user): bool
    {
        if ($user instanceof Admin) {
            return $user->hasPermissionTo('company:create', 'admin');
        }

        if ($user instanceof Company) {
            return $user->hasPermissionTo('company:create', 'company');
        }

        return false;
    }

    public function update($user, Company $company): bool
    {
        if ($user instanceof Admin) {
            return $user->hasPermissionTo('company:update', 'admin');
        }

        if ($user instanceof Company) {
            return $user->hasPermissionTo('company:update', 'company') && $user->id === $company->id;
        }

        return false;
    }

    public function delete($user, Company $company): bool
    {
        if ($user instanceof Admin) {
            return $user->hasPermissionTo('company:delete', 'admin');
        }

        if ($user instanceof Company) {
            return $user->hasPermissionTo('company:delete', 'company') && $user->id === $company->id;
        }

        return false;
    }
}
