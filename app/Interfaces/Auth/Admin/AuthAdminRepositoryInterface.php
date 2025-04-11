<?php

namespace App\Interfaces\Auth\Admin;

interface AuthAdminRepositoryInterface
{
    public function create(array $data);
    public function login(array $credentials);
}
