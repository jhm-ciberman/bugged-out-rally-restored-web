<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/play', 'placeholder', ['heading' => 'Play'])->name('play');
Route::view('/bugs', 'placeholder', ['heading' => 'The Bugs'])->name('bugs.index');
Route::view('/bugs/{bug}', 'placeholder', ['heading' => 'Bug page'])->name('bugs.show');
Route::view('/tracks', 'placeholder', ['heading' => 'The Tracks'])->name('tracks.index');
Route::view('/restoration', 'placeholder', ['heading' => 'About the restoration'])->name('restoration');
