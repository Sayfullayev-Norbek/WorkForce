<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Services\EmployeeService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class EmployeeController extends Controller
{
    use AuthorizesRequests;

    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
        $this->authorizeResource(Employee::class, 'employee');
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $employees = $this->employeeService->getAllEmployees();
        return response()->json($employees);
    }

    /**
     * @param StoreEmployeeRequest $request
     * @return JsonResponse
     */
    public function store(StoreEmployeeRequest $request): JsonResponse
    {
        $employee = $this->employeeService->createEmployee($request->validated());
        return response()->json($employee, 201);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $employee = $this->employeeService->getEmployee($id);
        return response()->json($employee);
    }

    /**
     * @param UpdateEmployeeRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateEmployeeRequest $request, int $id): JsonResponse
    {
        $employee = $this->employeeService->updateEmployee($id, $request->all());
        return response()->json($employee);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $this->employeeService->deleteEmployee($id);
        return response()->json(null, 204);
    }
}
