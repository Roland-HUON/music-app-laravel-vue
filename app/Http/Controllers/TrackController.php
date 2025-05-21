<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Track;
use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class TrackController extends Controller
{
    public function index()
    {
        $tracks = Track::where('display', true)->get();
        return Inertia::render('track/index', [
            'tracks' => $tracks
        ]);
    }

    public function create()
    {
        return Inertia::render('track/create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min: 5', 'max:255'],
            'artist' => ['required', 'string', 'min: 5', 'max:50'],
            'display' => ['required', 'boolean'],
            'image' => ['nullable', 'file', 'extensions:jpg,png,jpeg,svg'],
            'music' => ['required', 'file', 'extensions:mp3,wav'],
        ]);

        dd($request->all());

        $uuid = Str::uuid();
        $musicpath = $request->music->storeAs('tracks/musics', $uuid . '.' . $request->music->extension());
        $imagespath = $request->image?->storeAs('tracks/images', $uuid . '.' . $request->image->extension());

        Track::create([
            'uuid' => $uuid,
            'title' => $request->title,
            'artist' => $request->artist,
            'image' => $imagespath,
            'music' => $musicpath,
            'display' => $request->display,
        ]);

        // $track = new Track();
        // $track->title = $request->title;
        // $track->artist = $request->artist;
        // $track->display = $request->display;
        // $track->save();

        return redirect()->route('tracks.index');
    }

    public function edit(Track $track)
    {
        return Inertia::render('track/edit', [
            'track' => $track,
        ]);
    }

    public function update(Request $request, Track $track)
    {
        $request->validate([
            'title' => ['required', 'string', 'min: 5', 'max:255'],
            'artist' => ['required', 'string', 'min: 5', 'max:50'],
            'display' => ['required', 'boolean'],
        ]);

        $track->title = $request->title;
        $track->artist = $request->artist;
        $track->display = $request->display;
        $track->save();

        return redirect()->route('tracks.index');
    }

    public function destroy(Track $track)
    {
        $track->delete();
        return redirect()->back();
    }
}
