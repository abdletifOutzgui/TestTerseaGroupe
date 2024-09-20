<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Http\Requests\TicketStoreRequest;
use App\Enums\RoleType;

class TicketController extends Controller
{
    /**
     * Display a listing of the tickets.
     *
     * @return InertiaResponse
     */
    public function index(): InertiaResponse
    {
        $query = Ticket::with(['appel', 'agent']);

        if (auth()->id() !== RoleType::Supervisor) {
            $query->where('agent_id', auth()->id());
        }

        $tickets = $query->paginate(15);

        return Inertia::render('Tickets/List', [
            'tickets' => $tickets
        ]);
    }

    /**
     * Show the form for creating a new Ticket.
     *
     * @return InertiaResponse
     */
    public function create(): InertiaResponse
    {
        return Inertia::render('Tickets/Create');
    }

    /**
     * Store a newly created Ticket in storage.
     *
     * @param Request $request
     * @return InertiaResponse
     */
    public function store(TicketStoreRequest $request): InertiaResponse
    {
        Ticket::create($request->validated());

        return Inertia::render('Tickets/Create');
    }

    /**
     * Show the form for editing the specified ticket.
     *
     * @param Tikcet $ticket
     * @return InertiaResponse
     */
    public function edit(Ticket $ticket): InertiaResponse
    {
        abort_if(
            ($ticket->agent_id !== auth()->id() && auth()->user()->role_id !== RoleType::Supervisor), 
            403
        );

        return Inertia::render('Tickets/Edit', [
            'ticket' => $ticket,
        ]);
    }

    /**
     * Display the specified Ticket.
     *
     * @param Ticket $ticket
     * @return InertiaResponse
     */
    public function show(Ticket $ticket): InertiaResponse
    {
        return Inertia::render('Tickets/Edit', [
            'ticket' => $ticket
        ]);
    }

    /**
     * Updating the specified call.
     *
     * @param Ticket $ticket
     * @param TicketStoreRequest $request
     * @return InertiaResponse
     */
    public function update(TicketStoreRequest $request, Ticket $ticket): InertiaResponse
    {
        $ticket->update($request->validated());

        return Inertia::render('Tickets/List');
    }

    /**
     * Remove the specified call from storage.
     *
     * @param Ticket $ticket
     * @return RedirectResponse
     */
    public function destroy(Ticket $ticket): RedirectResponse
    {
        $ticket->delete();

        return redirect()
                ->route('tickets.index')
                ->withSuccess("ticket a été supprimé !");
    }
}
