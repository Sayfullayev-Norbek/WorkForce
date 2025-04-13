<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class CompanyPolicy
{
    use HandlesAuthorization;

    public function viewAny($user): bool
    {
        return $user instanceof Admin
            ? $user->hasPermissionTo('company:view-any', 'admin')
            : $user instanceof Company && $user->hasPermissionTo('company:view-any', 'company');
    }

    public function view($user, Company $company): bool
    {
        return $user instanceof Admin
            ? $user->hasPermissionTo('company:view', 'admin')
            : $user instanceof Company && $user->hasPermissionTo('company:view', 'company') && $user->id === $company->id;
    }

    public function create($user): bool
    {
        return $user instanceof Admin
            ? $user->hasPermissionTo('company:create', 'admin')
            : $user instanceof Company && $user->hasPermissionTo('company:create', 'company');
    }

    public function update($user, Company $company): bool
    {
        return $user instanceof Admin
            ? $user->hasPermissionTo('company:update', 'admin')
            : $user instanceof Company && $user->hasPermissionTo('company:update', 'company') && $user->id === $company->id;
    }

    public function delete($user, Company $company): bool
    {
        return $user instanceof Admin
            ? $user->hasPermissionTo('company:delete', 'admin')
            : $user instanceof Company && $user->hasPermissionTo('company:delete', 'company') && $user->id === $company->id;
    }
}
