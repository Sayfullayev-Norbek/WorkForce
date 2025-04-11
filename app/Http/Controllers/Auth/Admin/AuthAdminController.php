<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admins\LoginAdminRequest;
use App\Http\Requests\Admins\StoreAdminRequest;
use App\Http\Resources\Admin\AdminResource;
use App\Http\Resources\AuthTokenResource;
use App\Services\Auth\Admin\AuthAdminService;
use Exception;
use Illuminate\Http\JsonResponse;

class AuthAdminController extends Controller
{
    private $authAdminService;

    public function __construct(AuthAdminService $authAdminService)
    {
        $this->authAdminService = $authAdminService;
    }

    /**
     * @param StoreAdminRequest $request
     * @return JsonResponse
     */
    public function register(StoreAdminRequest $request): JsonResponse
    {
        try {
            return $this->response(new AdminResource($this->authAdminService->register($request)), 200);
        } catch (Exception $exception) {
            return $this->error($exception->getMessage(), $exception->getCode());
        }
    }

    /**
     * @param LoginAdminRequest $request
     * @return JsonResponse
     */
    public function login(LoginAdminRequest $request): JsonResponse
    {
        try {
            return $this->response(new AuthTokenResource($this->authAdminService->login($request)), 200);
        } catch (Exception $exception) {
            return $this->error($exception->getMessage(), $exception->getCode());
        }
    }
}
