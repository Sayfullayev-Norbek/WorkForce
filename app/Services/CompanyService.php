<?php

namespace App\Services;

use App\Interfaces\CompanyRepositoryInterface;

class CompanyService
{
    protected $companyRepository;

    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }

    public function getAllCompanies()
    {
        return $this->companyRepository->all();
    }

    public function getCompany($id)
    {
        return $this->companyRepository->find($id);
    }

    public function createCompany(array $data)
    {
        return $this->companyRepository->create($data);
    }

    public function updateCompany($id, array $data)
    {
        return $this->companyRepository->update($id, $data);
    }

    public function deleteCompany($id)
    {
        return $this->companyRepository->delete($id);
    }
}
