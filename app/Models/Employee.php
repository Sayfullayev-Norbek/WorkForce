<?php

namespace App\Models;

use Database\Factories\EmployeeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Employee
 *
 * @property int $id
 * @property string $passport_number
 * @property string $last_name
 * @property string $first_name
 * @property string $middle_name
 * @property string $position
 * @property string $phone
 * @property string $address
 * @property string $latitude
 * @property string $longitude
 * @property int $zoom_level
 * @property int $company_id
 */
class Employee extends Model
{
    /** @use HasFactory<EmployeeFactory> */
    use HasApiTokens, HasRoles, HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'passport_number',
        'last_name',
        'first_name',
        'middle_name',
        'position',
        'phone',
        'address',
        'latitude',
        'longitude',
        'zoom_level',
        'company_id',
    ];

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
