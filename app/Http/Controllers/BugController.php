<?php

namespace App\Http\Controllers;

use App\Support\Bug;
use Illuminate\Contracts\View\View;

class BugController extends Controller
{
    /**
     * Show the list of bugs.
     */
    public function index(): View
    {
        return view('bugs.index', ['bugs' => Bug::all()]);
    }

    /**
     * Show a bug's page.
     */
    public function show(string $slug): View
    {
        return view('bugs.show', ['bug' => Bug::find($slug) ?? abort(404)]);
    }
}
