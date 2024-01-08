<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'username' => ['required', 'unique:' . User::class . ',username'],
            'email' => ['required', 'email', 'unique:' . User::class . ',username'],
            'password' => ['required', 'min:6', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/'],
            'alamat' => ['required', 'string'],
            'no_hp' => ['required', 'numeric', 'unique:' . User::class . ',no_hp'],
        ];
    }
}
