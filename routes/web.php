<?php

use App\Http\Controllers\BasicController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\TicketManagingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Basic Public Page Controller Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [BasicController::class, 'Home'])->name('basic.home');
Route::post('/search',[BasicController::class, 'Search'])->name('basic.search');
Route::get('/seat/{id}',[BasicController::class, 'Seat'])->name('basic.seat');


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

/*
|--------------------------------------------------------------------------
| Tickets Management Controller Routes
|--------------------------------------------------------------------------
*/
Route::get('/ticket-manage',[TicketManagingController::class,'index'])->name('ticket.manage');


/*
|--------------------------------------------------------------------------
| Coupon Controller Routes
|--------------------------------------------------------------------------
*/
Route::resource('/coupon',CouponController::class);
Route::post('coupon/filter',[CouponController::class,'filter'])->name('coupon.filter');


/*
|--------------------------------------------------------------------------
| USER Controller Routes
|--------------------------------------------------------------------------
*/
Route::resource('/users',UserController::class);
