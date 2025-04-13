<?php

namespace App\Repositories;

use App\Interfaces\CompanyRepositoryInterface;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class CompanyRepository implements CompanyRepositoryInterface
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Company::query()->with('employees')->get();
    }

    /**
     * @param int $id
     * @return Company|Collection|Model|null
     */
    public function find(int $id): Model|Collection|Company|null
    {
        return Company::query()->findOrFail($id);
    }

    /**
     * @param array $data
     * @return Company|Model
     */
    public function create(array $data): Model|Company
    {
        $data['password'] = Hash::make($data['password']);
        $company = Company::query()->create($data);
        $company->assignRole('company');

        return $company;
    }

    /**
     * @param int $id
     * @param array $data
     * @return Company|Collection|Model|null
     */
    public function update(int $id, array $data): Model|Collection|Company|null
    {
        $company = $this->find($id);
        $company->update($data);
        return $company;
    }

    /**
     * @param int $id
     * @return bool|null
     */
    public function delete(int $id): ?bool
    {
        $company = $this->find($id);
        return $company->delete();
    }
}
