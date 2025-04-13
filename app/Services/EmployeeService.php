<?php

namespace App\Services;

use App\Interfaces\EmployeeRepositoryInterface;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class EmployeeService
{
    protected $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    /**
     * @param array $data
     * @return Employee|Model
     */
    public function createEmployee(array $data): Model|Employee
    {
        return $this->employeeRepository->create($data);
    }

    /**
     * @return Collection
     */
    public function getAllEmployees(): Collection
    {
        return $this->employeeRepository->all();
    }

    /**
     * @param int $id
     * @return Employee|Collection|Model|null
     */
    public function getEmployee(int $id): Model|Collection|Employee|null
    {
        return $this->employeeRepository->find($id);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Employee|Collection|Model|null
     */
    public function updateEmployee(int $id, array $data): Model|Collection|Employee|null
    {
        return $this->employeeRepository->update($id, $data);
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function deleteEmployee(int $id): ?bool
    {
        return $this->employeeRepository->delete($id);
    }
}
