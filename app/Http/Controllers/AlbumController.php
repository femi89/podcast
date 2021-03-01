<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {

        $search = $request->get('search', '');

        $albums = Album::search($search)
            ->latest()
            ->paginate();

        return view('app.albums.index', compact('albums', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('app.albums.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'nullable|max:255|string',
            'description' => 'nullable|max:255|string',
        ]);

        $album = Album::create($validated);

        return redirect()
            ->route('albums.edit', $album)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Album $album
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Album $album)
    {

        return view('app.albums.show', compact('album'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Album $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Album $album)
    {

        return view('app.albums.edit', compact('album'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Album $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {

        $validated = $request->validate([
            'name' => 'nullable|max:255|string',
            'description' => 'nullable|max:255|string',
        ]);

        $album->update($validated);

        return redirect()
            ->route('albums.edit', $album)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Album $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Album $album)
    {
        $album->delete();

        return redirect()
            ->route('albums.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
