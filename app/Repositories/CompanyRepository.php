<?php

namespace App\Repositories;

use App\Interfaces\CompanyRepositoryInterface;
use App\Models\Admin;
use App\Models\Company;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class CompanyRepository implements CompanyRepositoryInterface
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function all(): \Illuminate\Support\Collection
    {
        $user = auth()->user();

        if ($user instanceof Admin) {
            return Company::with('employees')->get();
        }

        if ($user instanceof Company) {
            return Company::where('id', $user->id)->with('employees')->get();
        }

        return collect();
    }

    /**
     * @param int $id
     * @return Company|Collection|Model|null
     */
    public function find(int $id): Model|Collection|Company|null
    {
        $user = auth()->user();

        if ($user instanceof Admin){
            Company::query()->with('employees')->findOrFail($id);
        }

        if ($user instanceof Company) {
            return Company::query()->where('id', $user->id)->with('employees')->findOrFail($id);
        }

        return null;
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
