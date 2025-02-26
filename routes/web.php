<?php

use App\Http\Livewire\Modulos;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/', Modulos::class)->name('matriculas');

