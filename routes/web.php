<?php

use App\Http\Controllers\BasicController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FeedBackController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\SlotController;
use App\Http\Controllers\SslCommerzPaymentController;
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
Route::get('/seat/{id}',[BasicController::class, 'Seat'])->name('basic.seat')->middleware('auth.user');
Route::post('/cart',[BasicController::class, 'Cart'])->name('basic.cart')->middleware('auth.user');




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
Route::post('users/login',[UserController::class,'Login'])->name('users.login');
Route::post('users/logout',[UserController::class,'Logout'])->name('users.logout');

/*
|--------------------------------------------------------------------------
| Profile Controller Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth.user'])->group(function(){

    Route::get('/profile/cart',[ProfileController::class,'Cart'])->name('users.cart');
    Route::delete('/profile/cart/{id}',[ProfileController::class,'CartTrash'])->name('users.cart.trash');
    Route::get('profile/payment',[ProfileController::class,'PaymentInfo'])->name('users.payment');
    Route::get('profile/ticket/{id}',[ProfileController::class,'TicketInfo'])->name('users.ticket.info');
    Route::get('ticket/feedback/{id}',[FeedBackController::class,'index'])->name('feedback.home');
    Route::post('ticket/feedback/',[FeedBackController::class,'store'])->name('feedback.store');
    Route::get('payment/invoice/{id}',[ProfileController::class,'Invoice'])->name('paymentInvoice');

});


// SSLCOMMERZ Start

Route::post('payment/pay', [SslCommerzPaymentController::class, 'index'])->name('payment.pay');

Route::post('payment/success', [SslCommerzPaymentController::class, 'success'])->name('payment.success');
Route::post('payment/fail', [SslCommerzPaymentController::class, 'fail'])->name('payment.fail');
Route::post('payment/cancel', [SslCommerzPaymentController::class, 'cancel'])->name('payment.cancel');

//SSLCOMMERZ END


