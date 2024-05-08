<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleFormRequest extends FormRequest
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
            'category_id' => [
                'required',
            ],
            'title' => [
                'required',
            ],
            // 'uuid' => [
            //     'required',
            // ],
            // 'user_id' => [
            //     'required',
            // ],
            'category_id' => [
                'required',
            ],
            'brand_id' => [
                'required',
            ],
            'type_id' => [
                'required',
            ],
            'image_cover' => [
                'required',
            ],
            'variant_id' => [
                'required',
            ],
            'condition' => [
                'required',
            ],
            'seat' => [
                'required',
            ],
            'transmision' => [
                'required',
            ],
            'fuel' => [
                'required',
            ],
            'year' => [
                'required',
            ],
            'engine_capacity' => [
                'required',
            ],
            'odometer' => [
                'required',
            ],
            'plat_number' => [
                'required',
            ],
            'color' => [
                'required',
            ],
            'stnk' => [
                'required',
            ],
            'bpkb' => [
                'required',
            ],
            'faktur' => [
                'required',
            ],
            'grade_engine' => [
                'required',
            ],
            'grade_exterior' => [
                'required',
            ],
            'grade_interior' => [
                'required',
            ],
            'description' => [
                'required',
            ],
            'price' => [
                'required',
            ],
            'meta_title' => [
                'nullable',
            ],
            'meta_description' => [
                'nullable',
            ],
            'meta_keywords' => [
                'nullable',
            ]
        ];
    }
}
