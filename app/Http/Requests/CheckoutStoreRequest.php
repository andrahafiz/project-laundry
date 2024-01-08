<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutStoreRequest extends FormRequest
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
            'totalPrice'    => ['sometimes', 'integer'],
            'nohp_customer' => ['nullable', 'string'],
            'tipe_order'    => ['required'],
            'metode_pembayaran' => ['required'],
            'alamat'        => ['required_if:tipe_order,1'],
            'customer_name' => ['required', 'string'],
            'inp_uang'      => ['sometimes', 'gte:totalPrice']
        ];
    }

    public function messages()
    {
        return [
            'alamat.required_if'    => "Alamat harus diisi karena anda memilih tipe order antar jemput staff",
            'metode_pembayaran.required' => "Metode pembayaran harus diisi",
            'tipe_order.required'   => "Tipe order harus diisi",
            'nohp_customer.string'  => 'Nama customer wajib berupa karakter',
            'customer_name.required' => 'Nama customer wajib diisi',
            'customer_name.string'  => 'Nama customer wajib berupa karakter',
            'totalPrice.required'   => 'Terdapat kesalahan pada total harga',
            'totalPrice.integer'    => 'Terdapat kesalahan pada total harga ( harus angka )',
            'inp_uang.required'     => 'Inputan uang dari pelanggan harus diisi',
            'inp_uang.gte'          => 'Uang tidak cukup',
        ];
    }
}
