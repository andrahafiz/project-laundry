<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LaporanTransaksiRequest extends FormRequest
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
            'tgl_awal' => ['sometimes', 'date', 'date_format:Y-m-d'], //''
            'tgl_akhir' => ['sometimes', 'date', 'date_format:Y-m-d', 'after_or_equal:tgl_awal'],
        ];
    }

    public function messages()
    {
        return [
            'tgl_awal.date_format'     => 'Format tanggal harus Y-m-d',
            'tgl_akhir.date_format'    => 'Format tanggal harus Y-m-d',
            'tgl_akhir.after_or_equal' => 'Tanggal Akhir harus lebih besar atau sama dengan tanggal awal'
        ];
    }
}
