<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserDetailFormRequest extends FormRequest
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
            'first_name' => [
                'required',
                'string'
            ],
            'last_name' => [
                'nullable',
                'string'
            ],
            'birth_date' => [
                'required',
            ],
            'gender' => [
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
            'verified' => [
                'nullable',
            ],
            'cv' => [
                'required',
            ],
            'photo' => [
                'required',
            ],
        ];
    }
}
