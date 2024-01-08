<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => ['string', 'required', 'max:50'],
            'username' => ['string', 'required', 'max:50'],
            'email' => ['email', 'required'],
            'password' => ['sometimes'],
            'no_hp' => ['numeric', 'required'],
            'address' => ['string'],
            'image' => ['file', 'image', 'mimes:png,jpg'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi',
            'name.string' => 'Nama harus karakter',
            'name.max' => 'Nama tidak boleh lebih dari 50 karakter',

            'username.required' => 'Username wajib diisi',
            'username.string' => 'Username harus karakter',
            'username.max' => 'Username tidak boleh lebih dari 50 karakter',

            'password.required' => 'Password wajib diisi',

            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.max' => 'Email tidak boleh lebih dari 50 karakter',

            'no_hp.required' => 'No HP wajib diisi',
            'no_hp.numeric' => 'No HP tidak valid',

            'address.string' => 'Alamat harus karakter',

            'image.mimes' => 'Gambar harus berformat png atau jpg'
        ];
    }
}
