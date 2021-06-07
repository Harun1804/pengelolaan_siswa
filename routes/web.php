<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
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

Route::prefix('authenticate')->name('auth.')->group(function () {
    Route::get('login',[AuthController::class,'loginForm'])->name('login');
    Route::post('verify-login',[AuthController::class,'verifyLogin'])->name('verify');
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::prefix('siswa')->name('siswa.')->middleware('checkRole:admin')->group(function () {
        Route::get('/index', [SiswaController::class,'index'])->name('index');
        Route::post('/store',[SiswaController::class,'store'])->name('store');
        Route::get('/edit/{siswa}',[SiswaController::class,'edit'])->name('edit');
        Route::put('/{siswa}/update',[SiswaController::class,'update'])->name('update');
        Route::delete('/{siswa}/delete',[SiswaController::class,'delete'])->name('delete');
        Route::get('/{siswa}/profile',[SiswaController::class,'profile'])->name('profile');
        Route::post('/{id}/add-nilai',[SiswaController::class,'addNilai'])->name('addNilai');
    });
    
});

