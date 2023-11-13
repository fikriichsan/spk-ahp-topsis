<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\AlternatifModelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembobotanController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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


Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
// Route::get('/alternatif', [AlternatifController::class, 'index'])->middleware('auth');
// Route::get('/tambah', [AlternatifController::class, 'create'])->middleware('auth');
// Route::post('/tambah', [AlternatifController::class, 'store'])->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('/kriteria', KriteriaController::class);
    Route::resource('/alternatif', AlternatifController::class);

});

// Route::get('/test', [PembobotanController::class, 'hitung'])->name('test');
// Route::get('/alternatif', [AlternatifModelController::class, 'normalizeMatrix'])->name('alternatif');
// Route::get('/alternatifterbobot', [AlternatifModelController::class, 'weightedNormalizeMatrix'])->name('alternatifterbobot');
// Route::get('/ideal_solution', [AlternatifModelController::class, 'idealSolution'])->name('ideal_solution');