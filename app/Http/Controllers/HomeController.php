<?php

namespace App\Http\Controllers;

use App\Support\Bug;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Show the home page.
     */
    public function __invoke(): View
    {
        return view('home', ['bugs' => Bug::all()]);
    }
}
