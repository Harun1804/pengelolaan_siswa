<?php

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

Route::prefix('siswa')->name('siswa.')->group(function () {
    Route::get('/index', [SiswaController::class,'index'])->name('index');
    Route::post('/store',[SiswaController::class,'store'])->name('store');
    Route::get('/edit/{siswa}',[SiswaController::class,'edit'])->name('edit');
    Route::put('/{siswa}/update',[SiswaController::class,'update'])->name('update');
    Route::delete('/{siswa}/delete',[SiswaController::class,'delete'])->name('delete');
});
