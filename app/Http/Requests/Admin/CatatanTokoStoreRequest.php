<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CatatanTokoStoreRequest extends FormRequest
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
            'nama'          => ['string', 'max:255', 'required'],
            'tanggal'       => ['required', 'date'],
            'keterangan'    => ['string', 'max:255', 'required'],
            'image'         => ['sometimes', 'image', 'mimes:png,jpg,jpeg,webp'],
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Inputan nama produk wajib diisi',
            'nama.string' => 'Inputan nama produk harus karakter',
            'nama.max' => 'Inputan nama produk hanya boleh 255 karakter',

            'keterangan.required' => 'Inputan keterangna wajib diisi',
            'keterangan.string' => 'Inputan keterangna harus karakter',
            'keterangan.max' => 'Inputan keterangna hanya boleh 255 karakter',

            'image.image' => 'Harus gambar',
            'image.mimes' => 'Format gambar png, jpeg atau jpg',
            'image.size' => 'Ukuran gambar maksimal 1 MB',

            'tanggal.required' => 'Inputan tanggal wajib diisi',
            'tanggal.date' => 'Inputan tanggal harus berformat tanggal',
        ];
    }
}
