<?php

namespace App\Models\Dashboard;

use App\Models\Dashboard\Unit;
use App\Models\Dashboard\Member;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'cnpj', 'social_reason', 'fantasy_name',
        'email', 'image', 'status'
    ];
    
    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
