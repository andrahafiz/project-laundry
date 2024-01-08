<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class ProdukCreateRequest extends FormRequest
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
            'nama' => ['string', 'max:255', 'required'],
            'satuan'  => ['required', 'string'],
            'category' => ['required', 'exists:categories,id'],
            'deskripsi' => ['string', 'max:255', 'required'],
            'image' => ['sometimes', 'image', 'mimes:png,jpg,jpeg'],
            'harga' => ['numeric', 'required'],
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Nama produk wajib diisi',
            'nama.string' => 'Nama produk harus karakter',
            'nama.max' => 'Nama produk hanya boleh 255 karakter',

            'unit.required' => 'Satuan produk wajib diisi',
            'unit.string' => 'Satuan produk harus karakter',

            'category.required' => 'Kategory produk wajib diisi',
            'category.exists' => 'Kategory produk tidak terdaftar',

            'deskripsi.required' => 'Deskripsi produk wajib diisi',
            'deskripsi.string' => 'Deskripsi produk harus karakter',
            'deskripsi.max' => 'Deskripsi produk hanya boleh 255 karakter',

            'image.image' => 'Harus gambar',
            'image.mimes' => 'Format gambar png, jpeg atau jpg',
            'image.size' => 'Ukuran gambar maksimal 1 MB',

            'harga.required' => 'Harga produk wajib diisi',
            'harga.numeric' => 'Harga produk harus angka',
        ];
    }
}
