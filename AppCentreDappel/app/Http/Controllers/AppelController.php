<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Appel;
use Inertia\Response as InertiaResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AppelStoreRequest;
use App\Enums\RoleType;

/**
 * Class AppelController
 * 
 * This controller handles the management of (Appels), including listing, 
 * creating, editing, showing, and deleting call records.
 *
 * @package App\Http\Controllers
 */
class AppelController extends Controller
{
    /**
     * Display a listing of the calls.
     *
     * @return InertiaResponse
     */
    public function index(): InertiaResponse
    {
        $query = Appel::with(['agent']);

        if (auth()->user()->role_id !== RoleType::Supervisor) {
            $query->where('agent_id', auth()->id());
        }
        
        $appels = $query->paginate(10);

        return Inertia::render('Calls/List', [
            'appels' => $appels
        ]);
    }

    /**
     * Show the form for creating a new call.
     *
     * @return InertiaResponse
     */
    public function create(): InertiaResponse
    {
        return Inertia::render('Calls/Create');
    }

    /**
     * Store a newly created call in storage.
     *
     * @param AppelStoreRequest $request
     * @return InertiaResponse
     */
    public function store(AppelStoreRequest $request): InertiaResponse
    {
        Appel::create($request->validated());

        return Inertia::render('Calls/List');
    }

    /**
     * Updating the specified call.
     *
     * @param Appel $Appel
     * @param AppelStoreRequest $request
     * @return InertiaResponse
     */
    public function update(AppelStoreRequest $request, Appel $appel): InertiaResponse
    {
        $appel->update($request->validated());

        return Inertia::render('Calls/List');
    }

    /**
     * Show the form for editing the specified call.
     *
     * @param Appel $Appel
     * @return InertiaResponse
     */
    public function edit(Appel $appel): InertiaResponse
    {
        abort_if(
            ($appel->agent_id !== auth()->id() && auth()->user()->role_id !== RoleType::Supervisor), 
            403
        );
        
        return Inertia::render('Calls/Edit', [
            'appel' => $appel,
        ]);
    }

    /**
     * Display the specified call.
     *
     * @param Appel $appel
     * @return InertiaResponse
     */
    public function show(Appel $appel): InertiaResponse
    {
        return Inertia::render('Calls/Edit', [
            'appel' => $appel
        ]);
    }

    /**
     * Remove the specified call from storage.
     *
     * @param Appel $appel
     * @return RedirectResponse
     */
    public function destroy(Appel $appel): RedirectResponse
    {
        abort_if(
            ($appel->agent_id !== auth()->id() && auth()->user()->role_id !== RoleType::Supervisor), 
            403
        );

        $appel->delete();

        return redirect()
                ->route('appels.index')
                ->withSuccess("L'appel a été supprimé !");
    }
}
