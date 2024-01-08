<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfitStoreRequest extends FormRequest
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
            'penjualan_bersih' => ['required', 'numeric'],
            'sewa_ruko' => ['required', 'numeric'],
            'beban_lain' => ['required', 'numeric'],
            'beban_air' => ['required', 'numeric'],
            'beban_listrik' => ['required', 'numeric'],
            'beban_gaji' => ['required', 'numeric'],
            'total_beban' => ['required', 'numeric'],
            'pajak' => ['required', 'numeric'],
            'laba_bersih' => ['required', 'numeric'],
            'periode' => ['required', 'date_format:Y-m'],
        ];
    }
}
