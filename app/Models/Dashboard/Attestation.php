<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class Attestation extends Model
{
    protected $fillable = [
        'pacient_id', 'companion', 'contract_id',
        'demise', 'attestation_id'
    ];
}
