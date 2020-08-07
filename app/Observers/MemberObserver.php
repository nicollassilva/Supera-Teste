<?php

namespace App\Observers;

use App\Models\Dashboard\Member;

class MemberObserver
{
    /**
     * Handle the member "updating" event.
     *
     * @param  \App\Models\Dashboard\Member  $member
     * @return void
     */
    public function updating(Member $member)
    {
        $member->contract_id = $member->contract->id;
    }
}
