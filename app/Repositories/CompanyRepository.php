<?php

namespace App\Repositories;

use App\Models\Company;

class CompanyRepository
{
    public function all()
    {
        return Company::all();
    }

    public function find($id)
    {
        return Company::query()->findOrFail($id);
    }

    public function create(array $data)
    {
        return Company::query()->create($data);
    }

    public function update($id, array $data)
    {
        $company = $this->find($id);
        $company->update($data);
        return $company;
    }

    public function delete($id)
    {
        $company = $this->find($id);
        return $company->delete();
    }
}
