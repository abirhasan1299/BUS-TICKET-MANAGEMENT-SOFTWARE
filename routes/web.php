<?php

use App\Http\Controllers\BasicController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\RouteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Basic Controller Routes
|--------------------------------------------------------------------------
*/

Route::get('/dashboard',[BasicController::class,'Dashboard'])->name('basic.dashboard');


/*
|--------------------------------------------------------------------------
| Route Controller Routes
|--------------------------------------------------------------------------
*/
Route::resource('/route',RouteController::class);
Route::post('route/filter',[RouteController::class,'filter'])->name('route.filter');



/*
|--------------------------------------------------------------------------
| Driver Controller Routes
|--------------------------------------------------------------------------
*/
Route::resource('/driver',DriverController::class);
Route::post('driver/filter',[DriverController::class,'filter'])->name('driver.filter');
