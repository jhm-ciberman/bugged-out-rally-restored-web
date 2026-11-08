<?php

use App\Http\Controllers\BugController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrackController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::view('/play', 'play')->name('play');

Route::get('/bugs', [BugController::class, 'index'])->name('bugs.index');
Route::get('/bugs/{slug}', [BugController::class, 'show'])->name('bugs.show');

Route::get('/tracks', [TrackController::class, 'index'])->name('tracks.index');
Route::get('/tracks/{slug}', [TrackController::class, 'show'])->name('tracks.show');

Route::view('/restoration', 'restoration')->name('restoration');
