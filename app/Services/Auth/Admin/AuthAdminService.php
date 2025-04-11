<?php

namespace App\Services\Auth\Admin;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthAdminService
{
    /**
     * @param $request
     * @return Admin|Model
     */
    public function register($request): Model|Admin
    {
        $admin = Admin::query()
                ->create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);

        $admin->assignRole('admin');

        return $admin;
    }

    /**
     * @param $request
     * @return array
     */
    public function login($request): array
    {
        $admin = Admin::query()
            ->where('email', $request['email'])
            ->firstOrFail();

        $token = $admin
            ->createToken('admin_auth_token', ['role:admin'], Carbon::now()
                ->addMinutes(config('sanctum.expiration')))
            ->plainTextToken;

        $admin
            ->createToken('admin_refresh_token', ['role:refresh_token'], Carbon::now()
                ->addMinutes(config('sanctum.rt_expiration')));

        $refresh_token = DB::table('personal_access_tokens')
            ->where([
                ['tokenable_type', 'App\Models\Admin'],
                ['tokenable_id', $admin->id],
                ['name', 'admin_refresh_token'],
            ])
            ->orderBy('created_at', 'desc')
            ->first()
            ->token;

        return [
            'access_token' => $token,
            'refresh_token' => $refresh_token,
        ];
    }
}
