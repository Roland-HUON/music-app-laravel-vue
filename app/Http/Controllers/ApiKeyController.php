<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ApiKey;
use Inertia\Inertia;

class ApiKeyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apiKeys = ApiKey::all();

        return Inertia::render('ApiKey/Index', [
            'apiKeys' => $apiKeys,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $apiKeys = ApiKey::where('user_id', auth()->user()->id)->get();

        return Inertia::render('ApiKey/Create', [
            'apiKeys' => $apiKeys,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:5', 'max:255'],
        ]);

        $uuid = Str::uuid();
        $key = Str::random(40);

        ApiKey::create([
            'uuid' => $uuid,
            'user_id' => $request->user()->id,
            'name' => $request->name,
            'key' => $key,
        ]);

        return redirect()->route('apikeys.index');
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Playlist $playlist)
    // {
    //     return Inertia::render('Playlist/Show', [
    //         'playlist' => $playlist->load('tracks'),
    //     ]);
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ApiKey $apiKey)
    {
        $apiKey->delete();

        return redirect()->route('dashboard');
    }
}
