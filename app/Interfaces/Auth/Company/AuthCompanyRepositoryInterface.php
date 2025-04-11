<?php

namespace App\Interfaces\Auth\Company;

interface AuthCompanyRepositoryInterface
{
    public function create(array $data);
    public function login(array $credentials);
}
