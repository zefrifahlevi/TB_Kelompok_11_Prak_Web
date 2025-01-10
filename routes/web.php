<?php

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

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('/login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::get('/dashboard', [TransactionController::class, 'index'])->name('dashboard')->middleware('auth');
Route::resource('transactions', TransactionController::class)->middleware('auth');


Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


