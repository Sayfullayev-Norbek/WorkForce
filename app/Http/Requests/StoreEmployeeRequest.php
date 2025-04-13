<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'passport_number' => 'required|string|unique:employees,passport_number',
            'last_name'       => 'required|string|max:255',
            'first_name'      => 'required|string|max:255',
            'middle_name'     => 'nullable|string|max:255',
            'position'        => 'required|string|max:255',
            'phone'           => 'required|string|unique:employees,phone',
            'address'         => 'nullable|string',
            'latitude'        => 'nullable|string|unique:employees,latitude',
            'longitude'       => 'nullable|string|unique:employees,longitude',
            'zoom_level'      => 'nullable|integer',
            'company_id'      => 'required|exists:companies,id',
        ];
    }
}
