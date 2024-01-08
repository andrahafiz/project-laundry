<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackUpdateRequest extends FormRequest
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
            'user_id' => ['sometimes', 'nullable', 'exists:users,id'], //''
            'description' => ['sometimes', 'nullable'],
            'customer_name' => ['sometimes', 'nullable'],
            'nohp_customer' => ['sometimes', 'nullable'],
            'inp_jawaban1' => ['required', 'string'],
            'inp_jawaban2' => ['required', 'string'],
            'inp_jawaban3' => ['required', 'string'],
            'inp_jawaban4' => ['required', 'string'],
            'inp_jawaban5' => ['required', 'string'],
            'inp_jawaban5' => ['required', 'string'],
        ];
    }
}
