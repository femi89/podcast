<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Guest::class);

        $search = $request->get('search', '');

        $guests = Guest::search($search)
            ->latest()
            ->paginate();

        return view('app.guests.index', compact('guests', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Guest::class);

        return view('app.guests.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Guest::class);

        $validated = $request->validate([
            'name' => 'nullable|max:255|string',
            'email' => 'nullable|email',
        ]);

        $guest = Guest::create($validated);

        return redirect()
            ->route('guests.edit', $guest)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Guest $guest
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Guest $guest)
    {
        $this->authorize('view', $guest);

        return view('app.guests.show', compact('guest'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Guest $guest
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Guest $guest)
    {
        $this->authorize('update', $guest);

        return view('app.guests.edit', compact('guest'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Guest $guest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guest $guest)
    {
        $this->authorize('update', $guest);

        $validated = $request->validate([
            'name' => 'nullable|max:255|string',
            'email' => 'nullable|email',
        ]);

        $guest->update($validated);

        return redirect()
            ->route('guests.edit', $guest)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Guest $guest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Guest $guest)
    {
        $this->authorize('delete', $guest);

        $guest->delete();

        return redirect()
            ->route('guests.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
