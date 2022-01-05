<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\LokasiController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
//LOGIN AND LOGOUT
Route::get('/',[LoginController::class, 'index'])->name('index');
Route::post('/', [LoginController::class, 'postLogin'])->name('login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
// END LOGIN AND LOGOUT
Route::group(['middleware' => ['auth']], function(){
    // INBOUND
    Route::get('/dashboard',[ReceiptOrderController::class, 'index'])->name('index');

    Route::get('/searchtrec',[ReceiptOrderController::class, 'show'])->name('searchtrec');

    Route::post('/getInbound',[ReceiptOrderController::class, 'getInbound'])->name('getInbound');

    Route::post('/getPallet',[ReceiptOrderController::class, 'getPallet'])->name('getPallet');

    Route::post('/getPalletId',[ReceiptOrderController::class, 'getPalletId'])->name('getPalletId');

    Route::post('/getPo',[ReceiptOrderController::class, 'getPo'])->name('getPo');

    Route::post('/getWhrPO',[ReceiptOrderController::class, 'getWhrPO'])->name('getWhrPO');

    Route::post('/getCQty',[ReceiptOrderController::class, 'getCQty'])->name('getCQty');

    Route::post('/sumQty',[ReceiptOrderController::class, 'sumQty'])->name('sumQty');

    Route::post('/getPalletCap',[ReceiptOrderController::class, 'getPalletCap'])->name('getPalletCap');

    Route::post('/getIdCrtn',[ReceiptOrderController::class, 'getIdCrtn'])->name('getIdCrtn');

    Route::get('/insertQty',[ReceiptOrderController::class, 'insertQty'])->name('insertQty');
    // END INBOUND

    // OUTBOUND
    Route::get('/outbound',[OutboundController::class, 'index'])->name('index');

    Route::post('/getOutbound',[OutboundController::class, 'getOutbound'])->name('getOutbound');

    Route::post('/getPalletId',[OutboundController::class, 'getPalletId'])->name('getPalletId');

    Route::post('/getCQtyOut',[OutboundController::class, 'getCQtyOut'])->name('getCQtyOut');

    Route::post('/getPalletCapOut',[OutboundController::class, 'getPalletCapOut'])->name('getPalletCapOut');

    Route::post('/getIdCrtnOut',[OutboundController::class, 'getIdCrtnOut'])->name('getIdCrtnOut');

    Route::post('/getPoOutbound',[OutboundController::class, 'getPoOutbound'])->name('getPoOutbound');

    Route::post('/getPoOutbound',[OutboundController::class, 'getPoOutbound'])->name('getPoOutbound');

    // Route::post('/getKodeOut',[OutboundController::class, 'getKode'])->name('getKodeOut');

    // Route::post('/getNoTransOut',[OutboundController::class, 'getNoTrans'])->name('getNoTransOut');

    // Route::post('/getLokasiOut',[OutboundController::class, 'getLokasi'])->name('getLokasiOut');

    Route::get('/insOutbound',[OutboundController::class, 'insOutbound'])->name('insOutbound');
    // END OUTBOUND

    // LOKASI
    Route::get('/lokasi',[LokasiController::class, 'index'])->name('index');

    Route::post('getsku',[LokasiController::class, 'getSKU'])->name('getsku');

    Route::post('getinbound',[LokasiController::class, 'getInbound'])->name('getinbound');

    Route::post('getlokasi',[LokasiController::class, 'getLokasi'])->name('getlokasi');

    Route::get('updlokasi',[LokasiController::class, 'updLokasi'])->name('updlokasi');
});