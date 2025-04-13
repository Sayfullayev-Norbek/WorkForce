<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function all()
    {
        return Employee::all();
    }

    public function find($id)
    {
        return Employee::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Employee::query()->create($data);
    }

    public function update($id, array $data)
    {
        $employee = $this->find($id);
        $employee->update($data);
        return $employee;
    }

    public function delete($id)
    {
        $employee = $this->find($id);
        return $employee->delete();
    }
}
