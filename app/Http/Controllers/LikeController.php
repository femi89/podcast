<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Guest;
use App\Models\Podcast;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Like::class);

        $search = $request->get('search', '');

        $likes = Like::search($search)
            ->latest()
            ->paginate();

        return view('app.likes.index', compact('likes', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Like::class);

        $podcasts = Podcast::pluck('audio_url', 'id');
        $guests = Guest::pluck('name', 'id');

        return view('app.likes.create', compact('podcasts', 'guests'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Like::class);

        $validated = $request->validate([
            'podcast_id' => 'required|exists:podcasts,id',
            'guest_id' => 'required|exists:guests,id',
        ]);

        $like = Like::create($validated);

        return redirect()
            ->route('likes.edit', $like)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Like $like
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Like $like)
    {
        $this->authorize('view', $like);

        return view('app.likes.show', compact('like'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Like $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Like $like)
    {
        $this->authorize('update', $like);

        $podcasts = Podcast::pluck('audio_url', 'id');
        $guests = Guest::pluck('name', 'id');

        return view('app.likes.edit', compact('like', 'podcasts', 'guests'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Like $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        $this->authorize('update', $like);

        $validated = $request->validate([
            'podcast_id' => 'required|exists:podcasts,id',
            'guest_id' => 'required|exists:guests,id',
        ]);

        $like->update($validated);

        return redirect()
            ->route('likes.edit', $like)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Like $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Like $like)
    {
        $this->authorize('delete', $like);

        $like->delete();

        return redirect()
            ->route('likes.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
