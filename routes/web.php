<?php

use App\Models\Acara;
use App\Models\KasMasjid;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AcaraController;
use App\Http\Controllers\DonaturController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KasMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KasMasjidController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
})->Middleware('auth');

//route autentication
Route::get('login', [AuthController::class,'login'])->name('login')->Middleware('use_login');
Route::get('logout', [AuthController::class,'logout'])->name('logout');
Route::post('login', [AuthController::class,'authenticating']);
Route::post('register', [AuthController::class,'createregister']);
Route::get('register', [AuthController::class,'register'])->name('register')->Middleware('use_login');


Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard')->Middleware('auth');
Route::get('laporan', [LaporanController::class,'index'])->name('laporan')->Middleware('auth');
// Route::get('dashboard', [DashboardController::class,'calculateSaldo']);

Route::get('/donatur', [DonaturController::class,'donatur'])->name('donatur');
Route::get('/donatur-add', [DonaturController::class,'create'])->name('donatur-add');
Route::post('/donatur', [DonaturController::class,'store']);
Route::get('/editdonatur/{id}', [DonaturController::class,'edit'])->name('donaturedit');
Route::put('/updatedonatur/{id}', [DonaturController::class,'update'])->name('updatedonatur');
Route::delete('/deletedonatur/{id}', [DonaturController::class,'delete'])->name('deletedonatur');

//kas masjidRoute::get('/transactions/income', [TransactionController::class, 'createIncome'])->name('transactions.create_income');
Route::get('/kasmasjid', [KasMasjidController::class, 'index'])->name('kasmasjid')->Middleware('auth');
Route::get('/createmasuk', [KasMasjidController::class,'create'])->name('create')->Middleware('auth');
Route::post('/kasstore', [KasMasjidController::class,'store'])->name('kas.store');
Route::get('/edit/{id}', [KasMasjidController::class,'edit'])->name('kasedit')->Middleware('auth'); 
Route::put('/update/{id}', [KasMasjidController::class,'update'])->name('updatekas'); 
Route::delete('/delete/{id}', [KasMasjidController::class,'delete'])->name('deletekas');
Route::get('/chart-data', [KasMasjidController::class, 'getChartData'])->name('chart.data');

Route::get('events', [AcaraController::class,'index'])->name('acara');
Route::get('createacara', [AcaraController::class,'create'])->name('create-acara');
Route::post('storeacara', [AcaraController::class,'store'])->name('store-acara');
Route::get('editacara/{id}', [AcaraController::class,'edit'])->name('edit-acara');
Route::put('updateacara/{id}', [AcaraController::class,'update'])->name('update-acara');
Route::delete('deleteacara/{id}', [AcaraController::class,'destroy'])->name('delete-acara');