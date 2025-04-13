<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Company;
use App\Models\Employee;

class EmployeePolicy
{
    public function viewAny($user, Employee $employee): bool
    {
        if ($user instanceof Admin) {
            return $user->hasPermissionTo('employee:view-any', 'admin');
        }

        if ($user instanceof Company) {
            return $user->hasPermissionTo('employee:view-any', 'company') && $user->id === $employee->company_id;
        }

        return false;
    }

    public function view($user, Employee $employee): bool
    {
        if ($user instanceof Admin) {
            return $user->hasPermissionTo('employee:view', 'admin');
        }

        if ($user instanceof Company) {
            return $user->hasPermissionTo('employee:view', 'company') && $user->id === $employee->company_id;
        }

        return false;
    }

    public function create($user): bool
    {
        return $user instanceof Company && $user->hasPermissionTo('employee:create');
    }

    public function update($user, Employee $employee): bool
    {
        if ($user instanceof Company) {
            return $user->hasPermissionTo('employee:update') && $user->id === $employee->company_id;
        }

        return false;
    }

    public function delete($user, Employee $employee): bool
    {
        if ($user instanceof Company) {
            return $user->hasPermissionTo('employee:delete') && $user->id === $employee->company_id;
        }

        return false;
    }
}
