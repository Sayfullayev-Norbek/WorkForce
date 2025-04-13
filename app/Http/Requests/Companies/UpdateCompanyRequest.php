<?php

namespace App\Http\Requests\Companies;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
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
            'company_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email',
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'middle_name' => 'sometimes|string|max:255',
            'password' => 'required|min:8|confirmed',
            'address' => 'sometimes|string|max:255',
            'latitude' => 'sometimes|string',
            'longitude' => 'sometimes|string',
            'zoom_level' => 'sometimes|integer',
            'website' => 'sometimes|url',
            'phone' => 'sometimes|string|max:15',
        ];
    }
}
