<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Comment;
use App\Models\Podcast;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Comment::class);

        $search = $request->get('search', '');

        $comments = Comment::search($search)
            ->latest()
            ->paginate();

        return view('app.comments.index', compact('comments', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Comment::class);

        $podcasts = Podcast::pluck('audio_url', 'id');
        $guests = Guest::pluck('name', 'id');

        return view('app.comments.create', compact('podcasts', 'guests'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Comment::class);

        $validated = $request->validate([
            'podcast_id' => 'required|exists:podcasts,id',
            'guest_id' => 'required|exists:guests,id',
        ]);

        $comment = Comment::create($validated);

        return redirect()
            ->route('comments.edit', $comment)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Comment $comment)
    {
        $this->authorize('view', $comment);

        return view('app.comments.show', compact('comment'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $podcasts = Podcast::pluck('audio_url', 'id');
        $guests = Guest::pluck('name', 'id');

        return view(
            'app.comments.edit',
            compact('comment', 'podcasts', 'guests')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validated = $request->validate([
            'podcast_id' => 'required|exists:podcasts,id',
            'guest_id' => 'required|exists:guests,id',
        ]);

        $comment->update($validated);

        return redirect()
            ->route('comments.edit', $comment)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return redirect()
            ->route('comments.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
