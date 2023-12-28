<?php

use App\Mail\LowHoursEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VirtualPosController;
use App\Http\Controllers\ShowButtonsController;
use App\Http\Controllers\PostPurchaseController;
use App\Http\Controllers\PurchaseSelectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/pago-horas',[PurchaseSelectController::class,'index'])->name('payment-select');

Route::post('/compra',[VirtualPosController::class,'create_payment'])->name('purchase');

//Route::get('/post-compra/{uuid}', [PostPurchaseController::class,'get_payment_info']);
Route::post('/post-compra',[PostPurchaseController::class,'receive_payment']);

Route::get('/declined', function () {
    return view('payment-declined', [
        'reason' => 'pending',
        'merchant_internal_code' => '123'
    ]);
});

Route::post('/create-document',function(){
    return 'TODO';
})->name('create-document');


Route::get('/', function () {
    return "Para pagar haga click <a href='/pago-horas?uuid=9ae16ef9-bcf8-46ac-a8d5-29eaef450b45'>aqui</a>";
});
