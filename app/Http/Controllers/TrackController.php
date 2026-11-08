<?php

namespace App\Http\Controllers;

use App\Support\Track;
use Illuminate\Contracts\View\View;

class TrackController extends Controller
{
    /**
     * Show the list of tracks.
     */
    public function index(): View
    {
        return view('tracks.index', ['tracks' => Track::all()]);
    }

    /**
     * Show a track's page.
     */
    public function show(string $slug): View
    {
        return view('tracks.show', ['track' => Track::find($slug) ?? abort(404)]);
    }
}
