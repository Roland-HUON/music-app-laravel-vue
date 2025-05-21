<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PlaylistRequest;
use App\Models\Playlist;
use App\Models\Track;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::with('tracks')->withCount('tracks')->get();
        return Inertia::render('playlist/index', [
            'playlists' => $playlists
        ]);
    }

    public function show(Playlist $playlist)
    {
        return Inertia::render('playlist/show', [
            'playlist' => $playlist
        ]);
    }

    public function create()
    {
        $tracks = Track::where('display', true)->get();
        return Inertia::render('playlist/create', [
            'tracks' => $tracks,
        ]);
    }

    public function store(PlaylistRequest $request)
    {
        $tracks = Track::whereIn('uuid', $request->tracks)->where('display', true)->get();

        if($tracks->count() !== count($request->tracks)) {
            throw ValidationException::withMessages([
                'tracks' => 'Tracks not found',
            ]);
        }   

        $playlist = Playlist::create([
            'uuid' => Str::uuid(),
            'user_id' => $request->user()->id,
            'title' => $request->title,
        ]);

        $playlist->tracks()->attach($tracks->pluck('id'));

        return redirect()->route('playlist.index');
    }

    public function edit(Playlist $playlist)
    {
        return Inertia::render('playlist/edit', [
            'playlist' => $playlist
        ]);
    }

    public function update(PlaylistRequest $request, Playlist $playlist)
    {
        // 
    }

    public function destroy(Playlist $playlist)
    {
        $playlist->delete();
        return redirect()->back();
    }
}
