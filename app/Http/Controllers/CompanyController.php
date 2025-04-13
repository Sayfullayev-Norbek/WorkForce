<?php

namespace App\Http\Controllers;

use App\Http\Requests\Companies\StoreCompanyRequest;
use App\Http\Requests\Companies\UpdateCompanyRequest;
use App\Http\Resources\Company\CompanyResource;
use App\Models\Company;
use App\Services\CompanyService;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{

    use AuthorizesRequests;
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
        $this->authorizeResource(Company::class, 'company');
    }

    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $result = $this->companyService->getAllCompanies();

            return $this->response(CompanyResource::collection($result), 201);
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
            $result = $this->companyService->getCompany($id);

            return $this->response(new CompanyResource($result), 201);
        } catch (Exception $exception) {
            return $this->error($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @param StoreCompanyRequest $request
     * @return JsonResponse
     */
    public function store(StoreCompanyRequest $request): JsonResponse
    {
        try {
            $result = $this->companyService->createCompany($request->validated());

            return $this->response(new CompanyResource($result), 201);
        } catch (Exception $exception) {
            return $this->error($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @param UpdateCompanyRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(UpdateCompanyRequest $request, int $id): JsonResponse
    {
        try {
            $result = $this->companyService->updateCompany($id, $request->validated());

            return $this->response(new CompanyResource($result), 201);
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
            $this->companyService->deleteCompany($id);

            return $this->success('Destroy',null, 201);
        } catch (Exception $exception) {
            return $this->error($exception->getMessage(), $exception->getCode());
        }
    }
}
