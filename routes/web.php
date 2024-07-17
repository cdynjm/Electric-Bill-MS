<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\BillController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\ChangePasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth'], function () {

	Route::group(['middleware' => 'verified'], function () {
	
		Route::get('/', [HomeController::class, 'home']);
		Route::get('/dashboard', [HomeController::class, 'home'])->name('dashboard');
		Route::get('/gcash', [BillController::class, 'gcash'])->name('gcash');
		Route::get('/paymaya', [BillController::class, 'paymaya'])->name('paymaya');
		Route::get('/view-receipt/{id}', [BillController::class, 'viewReceipt'])->name('view-receipt');

		Route::group(['middleware' => 'admin'], function () {
			Route::get('/create-bill', [BillController::class, 'createBill'])->name('create-bill');
			Route::get('/edit-bill/{id}', [BillController::class, 'editBill'])->name('edit-bill');
			Route::post('/create/bill', [BillController::class, 'storeBill']);
			Route::post('/update/bill', [BillController::class, 'updateBill']);
			Route::delete('/delete/bill', [BillController::class, 'deleteBill']);
			Route::post('/confirm/bill', [BillController::class, 'confirmBill']);
		});

		Route::group(['middleware' => 'user'], function () {
			Route::post('/pay/bill', [BillController::class, 'payBill']);
		});

	});

	Route::get('/email/verify', [VerifyEmailController::class, 'notVerified'])->name('verification.notice');
    Route::get('/logout', [SessionsController::class, 'destroy']);
	
});

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])->middleware('signed')->name('verification.verify');

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create'])->name('login');
    Route::post('/session', [SessionsController::class, 'store']);
	Route::post('/sign-in-with-google', [SessionsController::class, 'handleGoogleCallback']);

	Route::get('/login/forgot-password', [ResetController::class, 'create'])->name('forgot.password');
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');


});