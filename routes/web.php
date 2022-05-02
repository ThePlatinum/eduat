<?php

use App\Http\Controllers\HomeController;
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
    return view('auth.login');
})->middleware('guest');

Auth::routes();
Route::get('/dashboard', [HomeController::class, 'index'])->name('home');
Route::get('/accounts', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/classes', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/reports', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/teachers', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/students', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/profile', function () {
  return view('components.profile');
})->name('profile');
