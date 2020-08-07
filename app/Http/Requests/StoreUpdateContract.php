<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateContract extends FormRequest
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
            'cnpj' => ['required', 'min:13', 'integer', "unique:contracts,cnpj,{$id},id"],
            'social_reason' => ['required', 'min:10', 'max:255', "unique:contracts,social_reason,{$id},id"],
            'fantasy_name' => ['required', 'min:10', 'max:255'],
            'email' => ['required', 'min:10', 'max:255', "unique:contracts,email,{$id},id"],
            'image' => ['required', 'image'],
            'status' => ['required', 'in:0,1']
        ];

        if($this->method() == 'PUT') {
            $rules['image'] = ['nullable', 'image'];
        }

        return $rules;
    }
}
