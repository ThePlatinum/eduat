<?php

use App\Http\Controllers\ClassesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\TeachersController;
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
Route::get('/teachers', [TeachersController::class, 'teachers']);
Route::get('/students', [StudentsController::class, 'students'])->name('students');
Route::get('/profile',  [UserController::class, 'profile'])->name('profile');
Route::get('/settings',  [UserController::class, 'settings'])->name('settings');

// Profile routes
Route::get('/profile/edit',  [UserController::class, 'editprofile'])->name('editprofile');
Route::get('/profile/view/{user_id}',  [UserController::class, 'viewprofile'])->name('viewprofile');

// Class routes
Route::get('/classes/add', [ClassesController::class, 'addclass'])->name('addclass');
Route::post('/createclass', [ClassesController::class, 'create'])->name('createclass');
Route::post('/classes/view', [ClassesController::class, 'view'])->name('viewclass');

// Students routes
Route::get('/students/admission', [StudentsController::class, 'newstudent'])->name('newstudent');
Route::post('/admission', [StudentsController::class, 'admission'])->name('admission');
// Route::get('/students/view/{user_id}', [StudentsController::class, 'viewstudent'])->name('viewstudent');

// Teachers routes
Route::get('/teachers/new', [TeachersController::class, 'newteacher'])->name('newteacher');
Route::post('/employ', [TeachersController::class, 'employ'])->name('employ');