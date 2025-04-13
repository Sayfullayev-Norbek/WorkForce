<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

/**
 * Company
 *
 * @property int $id
 * @property string $company_name
 * @property string $last_name
 * @property string $first_name
 * @property string $middle_name
 * @property string $address
 * @property string $latitude
 * @property string $longitude
 * @property int $zoom_level
 * @property string $website
 * @property string $phone
 * @property string $email
 */
class Company extends Model implements Authenticatable, AuthorizableContract
{
    use HasApiTokens, HasRoles, AuthenticableTrait, Authorizable;

    protected string $guard_name = 'company';

    protected $fillable = [
        'company_name',
        'last_name',
        'first_name',
        'middle_name',
        'address',
        'latitude',
        'longitude',
        'zoom_level',
        'website',
        'phone',
        'email',
        'password',
    ];

    /**
     * @return HasMany
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
