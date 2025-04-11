<?php

namespace App\Models;

use Database\Factories\CompanyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

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
class Company extends Model
{
    /** @use HasFactory<CompanyFactory> */
    use HasApiTokens, HasRoles, HasFactory;

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
    ];

    /**
     * @return HasMany
     */
    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
