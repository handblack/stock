<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReportController;
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
    //return view('welcome');
    return redirect()->route('login');
});

Route::get('login', [AuthController::class,'login'])->name('login');
Route::post('login', [AuthController::class,'login_submit'])->name('login_submit');
Route::post('logout', [AuthController::class,'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/reporte/stock',[ReportController::class,'index'])->name('stock');
    Route::post('/reporte/download/move',[ReportController::class,'index_submit_move'])->name('index_submit_move');
    Route::post('/reporte/download/stock',[ReportController::class,'index_submit_stock'])->name('index_submit_stock');
});