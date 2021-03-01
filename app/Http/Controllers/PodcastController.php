<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Mp3D;
use App\Models\Podcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PodcastController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search', '');

        $podcasts = Podcast::search($search)
            ->latest()
            ->paginate();

        return view('app.podcasts.index', compact('podcasts', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(Request $request)
    {
       $albums = Album::all();

        return view('app.podcasts.create', compact('albums'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'album' => 'required|max:255|exists:albums,id',
            'title' => 'required|max:255|string',
            'podcast_file' => 'required|file|max:8045'
        ])->validated();

        $podcast = new Podcast();
        $title = $request->input('title');
        if($request->file()) {
            $accepted_duration = 5*60; //5 min in seconds
            $file = $request->file('podcast_file');
            $file_extension = $file->getClientOriginalExtension();
            $fileName = rand(111,999).'_'.$title;
            $fileName = (Str::slug($fileName)).'.'.$file_extension;
            $fileSize = $file->getSize();
            $temp_file = $file->storeAs('p-temp', $fileName);
            $temp_folder = base_path('storage/app/'.$temp_file);
            $mp3file = new Mp3D($temp_folder);
            $mp3_destination = base_path('storage/app/podcasts/');
            $duration = $mp3file->getDuration();//(slower) for VBR (or CBR)
            if ($duration > $accepted_duration) {
                return redirect()->back()->withErrors(['ppodcast_file'=>'The maximum duration allow is 5mins']);
            }
            $this->checkDir($mp3_destination);
            File::move($temp_folder, $mp3_destination.$fileName);

            $this->clearTempFolder();
            $podcast->title = $title;
            $podcast->size = $fileSize;
            $podcast->description = $request->input('description')??'unspecified';
            $podcast->album_id = $request->input('album');
            $podcast->audio_url = 'storage/app/podcasts/'.$fileName;
            $podcast->save();

        }
        return redirect()
            ->route('podcasts.edit', $podcast)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Podcast $podcast
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $podcast = Podcast::where('slug','=', $slug)->first();
        return view('play', compact('podcast'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Podcast $podcast
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Podcast $podcast)
    {
        $albums = Album::all();
        return view('app.podcasts.edit', compact('podcast', 'albums'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Podcast $podcast
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Podcast $podcast)
    {

        $validated = $request->validate([
            'album_id' => 'nullable|max:255',
            'title' => 'nullable|max:255|string',
            'audio_url' => 'nullable|max:255|string',
            'size' => 'nullable|max:255',
        ]);

        $podcast->update($validated);

        return redirect()
            ->route('podcasts.edit', $podcast)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Podcast $podcast
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Podcast $podcast)
    {
        $this->authorize('delete', $podcast);

        $podcast->delete();

        return redirect()
            ->route('podcasts.index')
            ->withSuccess(__('crud.common.removed'));
    }

    private function clearTempFolder()
    {
        //The name of the folder.
        $folder = base_path('storage/app/p-temp/');

        //Get a list of all of the file names in the folder.
        $files = glob($folder . '/*');

        //Loop through the file list.
        foreach ($files as $file) {
            //Make sure that this is a file and not a directory.
            if (is_file($file)) {
                //Use the unlink function to delete the file.
                unlink($file);
            }
        }
    }

    private function checkDir($path){
        if(!File::isDirectory($path)){
            File::makeDirectory($path);
        }
        return;
    }

    public function createComment(Request $request){
       $validator = $request->validate([
           'name' =>'required|string|max:255',
           'email' =>'required|email|max:255',
           'podcast_id'=>'required|integer|exists:podcasts,id',
           'message'=>'required|string|max:1500',
       ]);

       $comment = Comment::create($request->only(['name', 'podcast_id', 'message', 'email']));
        if(!$comment){
            return redirect()->back()->withErrors(['error'=>'Unable to create']);
        }
        return redirect()->back()->withSuccess('comment sent, thanks');
    }

    public function likePodcast(Request $request, Podcast $podcast){
        //check if the users cookies is save on on the browser
        $token = $request->header('cookie');
        $likes = Like::where('podcast_id', '=', $podcast->id)
        ->where('token', '=', $token)->first();
        if($likes === null){
         $like =  Like::create(['podcast_id'=>$podcast->id, 'token'=>$token]);
         if($like){
             return redirect()->back()->withSuccess('Complete');
         }
        }
        return redirect()->back();
    }

}
