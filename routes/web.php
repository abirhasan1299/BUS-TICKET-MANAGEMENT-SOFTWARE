<?php

use App\Http\Controllers\BasicController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\SlotController;
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


/*
|--------------------------------------------------------------------------
| BUS Controller Routes
|--------------------------------------------------------------------------
*/
Route::resource('/bus',BusController::class);


/*
|--------------------------------------------------------------------------
| Slot Controller Routes
|--------------------------------------------------------------------------
*/
Route::resource('/slot',SlotController::class);
Route::post('slot/filter',[SlotController::class,'filter'])->name('slot.filter');
