<?php

namespace App\Models\Dashboard;

use App\Models\Dashboard\Contract;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'integration_number', 'contract_id', 'email', 'state',
        'city', 'image', 'type', 'status'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
