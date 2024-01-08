<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModalUpdateRequest extends FormRequest
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
            'modal_awal' => ['required', 'numeric'],
            'laba_bersih' => ['required', 'numeric'],
            'modal_akhir' => ['required', 'numeric'],
            'periode' => ['required', 'date_format:Y-m'],
        ];
    }
}
