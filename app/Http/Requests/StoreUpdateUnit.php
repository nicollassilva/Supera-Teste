<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUnit extends FormRequest
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
        $id = $this->segment(2);
        
        $rules = [
            'cnpj_contract' => ['required', 'min:13', 'integer'],
            'integration_number' => ['required', 'integer', "unique:units,integration_number,{$id},id"],
            'email' => ['required', 'min:10', 'max:255', "unique:units,email,{$id},id"],
            'state' => ['required', 'min:1', 'max:2'],
            'city' => ['required', 'min:5', 'max:255'],
            'image' => ['required', 'image'],
            'type' => ['required', 'in:0,1,2,3'],
            'status' => ['required', 'in:0,1'],
        ];

        if($this->method() == 'PUT') {
            $rules['image'] = ['nullable', 'image'];
            $rules['cnpj_contract'] = ['nullable'];
            $rules['integration_number'] = ['nullable'];
        }

        return $rules;
    }
}
