<?php

namespace App\Services\Auth\Company;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthCompanyService
{
    /**
     * @param $request
     * @return Company|Model
     */
    public function register($request): Model|Company
    {
        $company = Company::query()
            ->create([
                'company_name' => $request->company_name,
                'email' => $request->email,
                'last_name' => $request->last_name,
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'phone' => $request->phone,
                'website' => $request->website,
                'address' => $request->address,
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
                'zoom_level' => $request->zoom_level,
                'password' => Hash::make($request->password),
            ]);

        $company->assignRole('company');

        return $company;
    }

    public function login($request): array
    {
        $company = Company::query()
            ->where('email', $request['email'])
            ->firstOrFail();

        $token = $company
            ->createToken('company_auth_token', ['role:company'], Carbon::now()
                ->addMinutes(config('sanctum.expiration')))
            ->plainTextToken;

        $company
            ->createToken('company_refresh_token', ['role:refresh_token'], Carbon::now()
                ->addMinutes(config('sanctum.rt_expiration')));

        $refresh_token = DB::table('personal_access_tokens')
            ->where([
                ['tokenable_type', 'App\Models\Company'],
                ['tokenable_id', $company->id],
                ['name', 'company_refresh_token'],
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
