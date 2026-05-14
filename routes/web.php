<?php

use App\Http\Controllers\SuratController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('surats.index'));

Route::resource('surats', SuratController::class);
