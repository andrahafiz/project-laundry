<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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

    public function rules()
    {
        return [
            'nama' => ['string', 'max:255', 'required'],
            'code' => ['string', 'max:10', 'required'],
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama produk wajib diisi',
            'nama.string' => 'Nama produk harus karakter',
            'nama.max' => 'Nama produk hanya boleh 255 karakter',
            'code.required' => 'Kode kategori produk wajib diisi',
            'code.string' => 'Kode kategori produk harus karakter',
            'code.max' => 'Kode kategori produk hanya boleh 10 karakter',
            // 'body.required' => 'A message is required',
        ];
    }
}
