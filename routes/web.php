<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\AlternatifModelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembobotanController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/profile', [LoginController::class, 'profile'] );


Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/', [HomeController::class, 'index']);
Route::get('/faq', [HomeController::class, 'faq']);
Route::get('/contact', [HomeController::class, 'contact']);
Route::get('/hasil', [AlternatifModelController::class, 'index']);
Route::get('/cari-rekomendasi', [AlternatifModelController::class, 'location']);
Route::post('/rekomendasi', [AlternatifModelController::class, 'hitungTopsisGuest']);
Route::post('/hasil-rekomendasi', [AlternatifModelController::class, 'hitungTopsis']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('/kriteria', KriteriaController::class);
    Route::resource('/alternatif', AlternatifController::class);

});
