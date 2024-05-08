<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id' => [
                'required',
                'integer'
            ],
            'name' => [
                'required',
                'string'
            ],
            'slug' => [
                'nullable',
                'string',
                'max:255'
            ],
            'type_id' => [
                'required',
                'string',
                'max:255'
            ],
            'short_description' => [
                'required',
                'string'
            ],
            'description' => [
                'required',
                'string'
            ],
            'price' => [
                'required',
            ],
            'single_price' => [
                'required',
            ],
            'full_price' => [
                'required',
            ],
            'link_demo' => [
                'required',
            ],
            'status' => [
                'nullable',
            ],
            'meta_title' => [
                'required',
                'string'
            ],
            'meta_description' => [
                'required',
                'string'
            ],
            'meta_keyword' => [
                'required',
                'string'
            ],
            'image' => [
                'nullable',
                // 'mimes:jpg,jpeg,png'
            ],
            'image_cover' => [
                'nullable',
                // 'mimes:jpg,jpeg,png'
            ],
            'file_download' => [
                'nullable',
                // 'mimes:jpg,jpeg,png'
            ],
            'views' => [
                'nullable',
                // 'mimes:jpg,jpeg,png'
            ],

        ];
    }
}
