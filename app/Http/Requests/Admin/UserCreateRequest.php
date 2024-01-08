<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'username' => ['string', 'required', 'unique:users,username', 'max:50'],
            'email' => ['email', 'required', 'unique:users,email'],
            'password' => ['required'],
            'no_hp' => ['numeric', 'required', 'unique:users,no_hp'],
            'address' => ['string'],
            'image' => ['file', 'image', 'mimes:png,jpg'],
            'roles' => ['string', 'required'],
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
            'username.unique' => 'Username telah digunakan',
            'username.max' => 'Username tidak boleh lebih dari 50 karakter',

            'password.required' => 'Password wajib diisi',

            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email tidak valid',
            'email.unique' => 'Email telah digunakan',
            'email.max' => 'Email tidak boleh lebih dari 50 karakter',

            'no_hp.required' => 'No HP wajib diisi',
            'no_hp.numeric' => 'No HP tidak valid',
            'no_hp.unique' => 'No HP telah digunakan',

            'address.string' => 'Alamat harus karakter',

            'image.mimes' => 'Gambar harus berformat png atau jpg'
        ];
    }
}
