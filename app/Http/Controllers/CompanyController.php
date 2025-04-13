<?php

namespace App\Http\Controllers;

use App\Http\Requests\Companies\StoreCompanyRequest;
use App\Http\Requests\Companies\UpdateCompanyRequest;
use App\Services\CompanyService;

class CompanyController extends Controller
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    public function index()
    {
        return response()->json($this->companyService->getAllCompanies());
    }

    public function show(int $id)
    {
        return response()->json($this->companyService->getCompany($id));
    }

    public function store(StoreCompanyRequest $request)
    {
        $company = $this->companyService->createCompany((array)$request);

        return response()->json($company, 201);
    }

    public function update(UpdateCompanyRequest $request, int $id)
    {
        $company = $this->companyService->updateCompany($id, (array)$request);

        return response()->json($company);
    }

    public function destroy(int $id)
    {
        $this->companyService->deleteCompany($id);

        return response()->json(null, 204);
    }
}
