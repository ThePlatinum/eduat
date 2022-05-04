<?php

use App\Http\Controllers\ClassesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
// Menus
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::get('/accounts', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/classes', [ClassesController::class, 'index'])->name('classes');
Route::get('/reports', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/teachers', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/students', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/profile',  [UserController::class, 'profile'])->name('profile');

// Class routes
Route::get('/classes/add', [ClassesController::class, 'addclass'])->name('addclass');
Route::post('/createclass', [ClassesController::class, 'create'])->name('createclass');
Route::post('/classes/view', [ClassesController::class, 'view'])->name('viewclass');