<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateAttestation extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'pacient' => ['required', 'integer'],
            'companion' => ['nullable', 'string'],
            'demise' => ['required', 'in:0,1'],
            'attestation_id' => ['required', 'integer', 'min:3']
        ];
    }
}
