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

Route::get('admin/login', [BasicController::class, 'adminLogin'])->name('admin.login');
Route::post('admin/verify', [BasicController::class, 'adminCheck'])->name('admin.check');

Route::middleware(['admin.auth'])->group(function(){
    Route::get('admin/payment',[ProfileController::class,'PaymentAdminInfo'])->name('admin.payment');
    Route::get('admin/logout',[BasicController::class,'AdminLogout'])->name('admin.logout');

    Route::resource('/coupon',CouponController::class);
    Route::post('coupon/filter',[CouponController::class,'filter'])->name('coupon.filter');
    Route::get('/dashboard',[BasicController::class,'Dashboard'])->name('basic.dashboard');

    Route::resource('/route',RouteController::class);
    Route::post('route/filter',[RouteController::class,'filter'])->name('route.filter');

    Route::resource('/driver',DriverController::class);
    Route::post('driver/filter',[DriverController::class,'filter'])->name('driver.filter');

    Route::resource('/bus',BusController::class);
    Route::resource('/slot',SlotController::class);
    Route::post('slot/filter',[SlotController::class,'filter'])->name('slot.filter');
});

/*
|--------------------------------------------------------------------------
| USER Controller and FORGET PASSWORD  Routes
|--------------------------------------------------------------------------
*/
Route::resource('/users',UserController::class);
Route::post('users/login',[UserController::class,'Login'])->name('users.login');
Route::post('users/logout',[UserController::class,'Logout'])->name('users.logout');
Route::get('user/forget-pasword/',[UserController::class,'ForgetPassword'])->name('forget.password');

Route::post('user/forget/',[UserController::class,'ForgetPasswordPost'])->name('forget.password.post');

Route::post('user/reset_password/',[UserController::class,'ResetPassword'])->name('forget.password.reset');



/*
|--------------------------------------------------------------------------
| USER Controller Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth.user'])->group(function(){

    Route::get('/seat/{id}',[BasicController::class, 'Seat'])->name('basic.seat')->middleware('auth.user');

    Route::post('/cart',[BasicController::class, 'Cart'])->name('basic.cart');

// SSLCOMMERZ Start

    Route::post('payment/pay', [SslCommerzPaymentController::class, 'index'])->name('payment.pay');

    Route::post('payment/success', [SslCommerzPaymentController::class, 'success'])->name('payment.success');


//SSLCOMMERZ END

    Route::get('/profile/cart',[ProfileController::class,'Cart'])->name('users.cart');
    Route::delete('/profile/cart/{id}',[ProfileController::class,'CartTrash'])->name('users.cart.trash');
    Route::get('profile/payment',[ProfileController::class,'PaymentInfo'])->name('users.payment');
    Route::get('profile/ticket/{id}',[ProfileController::class,'TicketInfo'])->name('users.ticket.info');
    Route::get('ticket/feedback/{id}',[FeedBackController::class,'index'])->name('feedback.home');
    Route::post('ticket/feedback/',[FeedBackController::class,'store'])->name('feedback.store');
    Route::get('payment/invoice/{id}',[ProfileController::class,'Invoice'])->name('paymentInvoice');

});






