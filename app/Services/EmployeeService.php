<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;
use Illuminate\Database\Eloquent\Collection;

class EmployeeService
{
    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function createEmployee(array $data)
    {
        return $this->employeeRepository->create($data);
    }

    public function getAllEmployees(): Collection
    {
        return $this->employeeRepository->all();
    }

    public function getEmployee($id)
    {
        return $this->employeeRepository->find($id);
    }

    public function updateEmployee($id, array $data)
    {
        return $this->employeeRepository->update($id, $data);
    }

    public function deleteEmployee($id): ?bool
    {
        return $this->employeeRepository->delete($id);
    }
}
