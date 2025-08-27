<?php

use App\Http\Controllers\BasicController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Basic Controller Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard',[BasicController::class,'Dashboard'])->name('basic.dashboard');
