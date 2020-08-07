<?php

namespace App\Models\Dashboard;

use App\Models\Dashboard\Contract;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name', 'cpf', 'contract_id'
    ];
    
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function attestation()
    {
        return $this->hasMany(Attestation::class);
    }

    public function search(Array $data)
    {
        if($data['cnpj_member'] != '' && ($contract = Contract::where('cnpj', $data['cnpj_member'])->first())) {
            $result = $this->where([['cpf', $data['cpf_member']], ['contract_id', $contract->id]])->first();
        } else {
            if(isset($contract) && !$contract) $result = ['error' => true];

            $result = $this->where('cpf', $data['cpf_member'])->first();
        }

        return $result ?? ['error' => true];
    }
}
