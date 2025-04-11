<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
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
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|unique:companies,email',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'password' => 'required|min:8|confirmed',
            'address' => 'nullable|string|max:255',
            'latitude' => 'nullable|string|unique:companies,latitude',
            'longitude' => 'nullable|string|unique:companies,longitude',
            'zoom_level' => 'nullable|integer',
            'website' => 'nullable|url',
            'phone' => 'nullable|string|max:15|unique:companies,phone',
        ];
    }
}
