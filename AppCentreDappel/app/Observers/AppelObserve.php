<?php

namespace App\Observers;

use App\Models\Appel;

class AppelObserve
{
    /**
     * Handle the Appel "saving" event.
     */
    public function creating(Appel $appel): void
    {
        $appel->agent_id = auth()->id();
    }
}
