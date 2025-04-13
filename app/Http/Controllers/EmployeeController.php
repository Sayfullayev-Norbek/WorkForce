<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Services\EmployeeService;

class EmployeeController extends Controller
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        $employees = $this->employeeService->getAllEmployees();
        return response()->json($employees);
    }

    public function create(StoreEmployeeRequest $request)
    {
        $employee = $this->employeeService->createEmployee((array) $request->all());
        return response()->json($employee, 201);
    }

    public function show($id)
    {
        $employee = $this->employeeService->getEmployee($id);
        return response()->json($employee);
    }

    public function update(UpdateEmployeeRequest $request, $id)
    {
        $employee = $this->employeeService->updateEmployee($id, $request->all());
        return response()->json($employee);
    }

    public function destroy($id)
    {
        $this->employeeService->deleteEmployee($id);
        return response()->json(null, 204);
    }
}
