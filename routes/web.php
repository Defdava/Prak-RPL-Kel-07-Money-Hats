<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Route::get('/', function () {
//     return redirect()->route('auth.register');
// });

Route::get('/admin/register', \App\Http\Livewire\Register::class)->name('auth.register');
