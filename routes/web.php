<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShowButtonsController;
use App\Http\Controllers\VirtualPosController;

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

Route::get('/pago-horas',[ShowButtonsController::class,'index']);

Route::post('/compra',[VirtualPosController::class,'create_payment'])->name('purchase');

Route::get('/post-compra', function () {
    return view('post-compra');
});

Route::get('/', function () {
    return "Para pagar haga click <a href='/pago-horas?email=qCwZf@example.com&first_name=Enrique&last_name=Olmedo'>aqui</a>";
});