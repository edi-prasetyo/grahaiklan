<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementFormRequest extends FormRequest
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
            'subcategory_id' => [
                'required',
            ],
            'description' => [
                'required', 'min:5',
            ],
            'name' => [
                'required',
            ],
            'email' => [
                'nullable',
            ],
            'phone' => [
                'required',
                'unique:advertisements'
            ],
            'website' => [
                'nullable',
            ],
            'url' => [
                'nullable',
            ],
            'province_id' => [
                'required',
            ],
            'city_id' => [
                'required',
            ],
            'address' => [
                'required',
            ],
            'meta_title' => [
                'required',
            ],
            'meta_description' => [
                'required',
            ],
            'meta_keywords' => [
                'required',
            ],
        ];
    }
    public function messages()
    {
        return [
            'category_id.required' => 'Pilih Kategori Iklan',
            'subcategory_id.required' => 'Pilih Sub kategori Iklan',
            'title.required' => 'Judul Harus Di Isi',
            'description.required' => 'Deskripsi Harus Di Isi',
            'description.min' => 'Harus 50 huruf',
            'name.required' => 'Nama Pengiklan Harus Di Isi',
            'phone.required' => 'Nomor Whatsapp Harus Di Isi',
            'phone.unique' => 'Nomor yang anda masukan sudah digunakan',
            'province_id.required' => 'Pilih Provinsi',
            'city_id.required' => 'Pilih Kota',
            'address.required' => 'Alamat Harus Di isi',
            'meta_title.required' => 'Sub Judul Harus Di isi',
            'meta_description.required' => 'Sub Deskripsi Harus Di isi',
            'meta_keywords.required' => 'Keyword Harus Di isi',


        ];
    }
}
