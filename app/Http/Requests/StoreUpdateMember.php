<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateMember extends FormRequest
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

        $rules = [
            'cnpj' => ['required', 'min:13', 'integer'],
            'name' => ['required', 'min:10', 'max:255'],
            'cpf' => ['required', 'min:10', 'integer']
        ];

        if($this->method() == 'PUT') {
            $rules['cnpj'] = ['nullable'];
        }

        return $rules;
    }
}
