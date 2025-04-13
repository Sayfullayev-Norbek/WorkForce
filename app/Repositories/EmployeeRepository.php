<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class EmployeeRepository implements EmployeeRepositoryInterface
{

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Employee::query()->where('company_id', auth()->user()->id)->get();
    }

    /**
     * @param int $id
     * @return Employee|Collection|Model|null
     */
    public function find(int $id): Model|Collection|Employee|null
    {
        return Employee::query()->findOrFail($id);
    }

    /**
     * @param array $data
     * @return Employee|Model
     */
    public function create(array $data): Model|Employee
    {
        return Employee::query()->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Employee|Collection|Model|null
     */
    public function update(int $id, array $data): Model|Collection|Employee|null
    {
        $employee = $this->find($id);
        $employee->update($data);
        return $employee;
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id): ?bool
    {
        $employee = $this->find($id);
        return $employee->delete();
    }
}
