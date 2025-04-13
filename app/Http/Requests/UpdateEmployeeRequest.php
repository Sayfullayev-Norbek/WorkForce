<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'passport_number' => ['nullable', 'string'],
            'last_name'       => 'nullable|string|max:255',
            'first_name'      => 'nullable|string|max:255',
            'middle_name'     => 'nullable|string|max:255',
            'position'        => 'nullable|string|max:255',
            'phone'           => ['nullable', 'string'],
            'address'         => 'nullable|string',
            'latitude'        => ['nullable', 'string'],
            'longitude'       => ['nullable', 'string'],
            'zoom_level'      => 'nullable|integer',
            'company_id'      => 'nullable|exists:companies,id',
        ];
    }
}
