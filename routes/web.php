<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\OutboundController;
use App\Http\Controllers\ReceiptOrderController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
//LOGIN AND REGISTER
// Route::get('/',[LoginController::class, 'index'])->name('index');

// Route::get('/register',[RegisterController::class, 'index'])->name('register');
// END LOGIN AND REGISTER
// Route::group(['middleware' => ['auth']], function(){
//     Route::get('/dashboard',[ReceiptOrderController::class, 'index'])->name('index');

//     Route::get('/searchtrec',[ReceiptOrderController::class, 'show'])->name('searchtrec');

//     Route::post('/getKode',[ReceiptOrderController::class, 'getKode'])->name('getKode');

//     Route::post('/getNoTrans',[ReceiptOrderController::class, 'getNoTrans'])->name('getNoTrans');

//     Route::post('/getLokasi',[ReceiptOrderController::class, 'getLokasi'])->name('getLokasi');

//     Route::get('/updsku',[ReceiptOrderController::class, 'updSKU'])->name('updSKU');
// });

// INBOUND
Route::get('/dashboard',[ReceiptOrderController::class, 'index'])->name('index');

Route::get('/searchtrec',[ReceiptOrderController::class, 'show'])->name('searchtrec');

Route::post('/getKode',[ReceiptOrderController::class, 'getKode'])->name('getKode');

Route::post('/getNoTrans',[ReceiptOrderController::class, 'getNoTrans'])->name('getNoTrans');

Route::post('/getLokasi',[ReceiptOrderController::class, 'getLokasi'])->name('getLokasi');

Route::get('/updsku',[ReceiptOrderController::class, 'updSKU'])->name('updSKU');
// END INBOUND

// OUTBOUND
Route::get('/outbound',[OutboundController::class, 'index'])->name('index');

Route::post('/getKodeOut',[OutboundController::class, 'getKode'])->name('getKodeOut');

Route::post('/getNoTransOut',[OutboundController::class, 'getNoTrans'])->name('getNoTransOut');

Route::post('/getLokasiOut',[OutboundController::class, 'getLokasi'])->name('getLokasiOut');

Route::get('/updskuOut',[OutboundController::class, 'updSKU'])->name('updSKUOut');
// END OUTBOUND