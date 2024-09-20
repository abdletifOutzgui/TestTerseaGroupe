<?php

namespace App\Observers;

use App\Models\Ticket;

class TicketObserve
{
    /**
     * Handle the Ticket "saving" event.
     */
    public function saving(Ticket $ticket): void
    {
        $ticket->agent_id = auth()->id();
    }

}
