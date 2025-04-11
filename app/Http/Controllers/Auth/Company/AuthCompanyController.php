<?php

namespace App\Http\Controllers\Auth\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\Companies\LoginCompanyRequest;
use App\Http\Requests\Companies\StoreCompanyRequest;
use App\Http\Resources\AuthTokenResource;
use App\Http\Resources\Company\CompanyResource;
use App\Services\Auth\Company\AuthCompanyService;
use Exception;
use Illuminate\Http\JsonResponse;

class AuthCompanyController extends Controller
{
    private $authCompanyService;

    public function __construct(AuthCompanyService $authCompanyService)
    {
        $this->authCompanyService = $authCompanyService;
    }

    /**
     * @param StoreCompanyRequest $request
     * @return JsonResponse
     */
    public function register(StoreCompanyRequest $request): JsonResponse
    {
        try {
            return $this->response(new CompanyResource($this->authCompanyService->register($request)), 200);
        } catch (Exception $exception) {
            return $this->error($exception->getMessage(), $exception->getCode());
        }
    }

    public function login(LoginCompanyRequest $request): JsonResponse
    {
        try {
            return $this->response(new AuthTokenResource($this->authCompanyService->login($request)), 200);
        } catch (Exception $exception) {
            return $this->error($exception->getMessage(), $exception->getCode());
        }
    }
}

