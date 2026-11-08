<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::view('/play', 'placeholder', ['heading' => 'Play'])->name('play');

Route::view('/bugs', 'bugs.index')->name('bugs.index');
Route::view('/bugs/beetle', 'bugs.beetle')->name('bugs.beetle');
Route::view('/bugs/ladybug', 'bugs.ladybug')->name('bugs.ladybug');
Route::view('/bugs/cockroach', 'bugs.cockroach')->name('bugs.cockroach');
Route::view('/bugs/grasshopper', 'bugs.grasshopper')->name('bugs.grasshopper');
Route::view('/bugs/hornet', 'bugs.hornet')->name('bugs.hornet');
Route::view('/bugs/praying-mantis', 'bugs.praying-mantis')->name('bugs.praying-mantis');
Route::view('/bugs/scorpion', 'bugs.scorpion')->name('bugs.scorpion');
Route::view('/bugs/blackwidow', 'bugs.blackwidow')->name('bugs.blackwidow');

Route::view('/tracks', 'placeholder', ['heading' => 'The Tracks'])->name('tracks.index');
Route::view('/restoration', 'placeholder', ['heading' => 'About the restoration'])->name('restoration');
