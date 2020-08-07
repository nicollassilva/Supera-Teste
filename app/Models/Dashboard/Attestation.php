<?php

namespace App\Models\Dashboard;

use Illuminate\Database\Eloquent\Model;

class Attestation extends Model
{
    protected $fillable = [
        'pacient_id', 'companion',
        'demise', 'attestation_id'
    ];
}
