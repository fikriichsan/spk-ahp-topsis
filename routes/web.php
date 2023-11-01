<?php

use App\Http\Controllers\AlternatifModelController;
use App\Http\Controllers\PembobotanController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', [PembobotanController::class, 'hitung'])->name('test');
Route::get('/alternatif', [AlternatifModelController::class, 'normalizeMatrix'])->name('alternatif');
Route::get('/alternatifterbobot', [AlternatifModelController::class, 'weightedNormalizeMatrix'])->name('alternatifterbobot');
Route::get('/ideal_solution', [AlternatifModelController::class, 'idealSolution'])->name('ideal_solution');