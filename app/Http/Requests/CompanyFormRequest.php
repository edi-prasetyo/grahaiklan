<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'company_name' => [
                'required',
                'string'
            ],
            'company_phone' => [
                'required',
            ],
            'description' => [
                'required',
                'string'
            ],
            'logo' => [
                'required',
                'string'
            ],
            'province_id' => [
                'required',
            ],
            'city_id' => [
                'required',
            ],
            'address' => [
                'required',
                'string'
            ],
            'status' => [
                'nullable',
            ],
        ];
    }
}
