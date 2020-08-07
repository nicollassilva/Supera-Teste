<?php

namespace App\Observers;

use App\Models\Dashboard\Unit;

class UnitObserver
{
    /**
     * Handle the units "updating" event.
     *
     * @param  \App\Models\\Dashboard\\Units  $units
     * @return void
     */
    public function updating(Unit $unit)
    {
        $unit->contract_id = $unit->contract->id;
    }
}