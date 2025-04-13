<?php

namespace App\Http\Controllers;

use App\Http\Resources\Employee\EmployeeResource;
use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Services\EmployeeService;
use Exception;
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
        try {
            $result = $this->employeeService->getAllEmployees();

            return $this->response(EmployeeResource::collection($result), 200);
        } catch (Exception $exception) {
            return $this->error($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @param StoreEmployeeRequest $request
     * @return JsonResponse
     */
    public function store(StoreEmployeeRequest $request): JsonResponse
    {
        try {
            $result = $this->employeeService->createEmployee($request->validated());

            return $this->response(new EmployeeResource($result), 200);
        } catch (Exception $exception) {
            return $this->error($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        try {
            $result = $this->employeeService->getEmployee($id);

            return $this->response(new EmployeeResource($result), 200);
        } catch (Exception $exception) {
            return $this->error($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @param UpdateEmployeeRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateEmployeeRequest $request, int $id): JsonResponse
    {
        try {
            $result = $this->employeeService->updateEmployee($id, $request->all());

            return $this->response(new EmployeeResource($result), 200);
        } catch (Exception $exception) {
            return $this->error($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        try {
            this->employeeService->deleteEmployee($id);

            return $this->success('Destroy',null, 200);
        } catch (Exception $exception) {
            return $this->error($exception->getMessage(), $exception->getCode());
        }
    }
}
