<?php

namespace App\Repositories\Auth\Admin;

use App\Interfaces\Auth\Admin\AuthAdminRepositoryInterface;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthAdminRepository implements AuthAdminRepositoryInterface
{
    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        $user = Admin::query()->create($data);
        $user->assignRole('admin');  // Assuming you're using Spatie Roles and Permissions

        return response()->json([
            'message' => 'Admin created successfully',
            'user' => $user
        ], 201);
    }

    public function login(array $credentials)
    {

    }
}
