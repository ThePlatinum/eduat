<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\KlassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SubjectController;
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

Route::GET('/', function () {
    return view('auth.login');
})->middleware('guest');
Route::GET('/login', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes();
// Menus
Route::GET('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::GET('accounts', [AccountsController::class, 'index'])->name('accounts');
Route::GET('items', [ItemsController::class, 'items'])->name('items');
Route::GET('classes', [KlassController::class, 'index'])->name('classes');
Route::GET('reports', [DashboardController::class, 'index'])->name('reports');
Route::GET('teachers', [TeachersController::class, 'teachers']);
Route::GET('students', [StudentsController::class, 'students'])->name('students');
Route::GET('profile',  [UserController::class, 'profile'])->name('profile');
Route::GET('settings',  [SettingsController::class, 'settings'])->name('settings');

// Profile
Route::GET('profile/edit',  [UserController::class, 'editprofile'])->name('editprofile');
Route::GET('profile/view/{user_id}',  [UserController::class, 'viewprofile'])->name('viewprofile');

// Class
Route::GET('classes/add', [KlassController::class, 'addclass'])->name('addclass');
Route::POST('createclass', [KlassController::class, 'create'])->name('createclass');
Route::GET('classes/edit/{class_id}', [KlassController::class, 'edit'])->name('edit');
Route::POST('editclass', [KlassController::class, 'editclass'])->name('editclass');
Route::GET('classes/view/{class_id}', [KlassController::class, 'viewclass'])->name('viewclass');
Route::POST('classes/subject/createsubject', [KlassController::class, 'createsubject'])->name('createsubject');
Route::POST('classes/subject/editsubject', [KlassController::class, 'editsubject'])->name('editsubject');

// Students
Route::GET('students/admission', [StudentsController::class, 'newstudent'])->name('newstudent');
Route::POST('admission', [StudentsController::class, 'admission'])->name('admission');
// Route::GET('students/view/{user_id}', [StudentsController::class, 'viewstudent'])->name('viewstudent');

// Teachers
Route::GET('teachers/new', [TeachersController::class, 'newteacher'])->name('newteacher');
Route::POST('employ', [TeachersController::class, 'employ'])->name('employ');
Route::GET('/subject/{subjects_id}', [SubjectController::class, 'teacherview'])->name('teacherview');
Route::POST('/assessment/make', [AssessmentController::class, 'create'])->name('makeassessment');
Route::GET('/assessment/{assessment_id}', [AssessmentController::class, 'gradingview'])->name('gradingview');
Route::POST('/assessment/addscore/{assessment_id}', [AssessmentController::class, 'addscore'])->name('addscore');

// Items
Route::GET('item/add', [ItemsController::class, 'additem'])->name('additem');
Route::POST('item/create', [ItemsController::class, 'create'])->name('create');
Route::POST('item/update', [ItemsController::class, 'edit'])->name('edititem');
Route::GET('item/edit/{item_id}', [ItemsController::class, 'edititem'])->name('updateitem');
Route::GET('item/delete/{item_id}', [ItemsController::class, 'deleteitem'])->name('deleteitem');

Route::POST('studentitem/create', [ItemsController::class, 'createstudentitem'])->name('createstudentitem');

// Accounts
Route::GET('accounts/{student_id}', [AccountsController::class, 'getaccounts'])->name('getaccounts');
Route::POST('addpayment', [AccountsController::class, 'storepayment'])->name('addpayment');

// Seetings
Route::POST('migrateclass', [SettingsController::class, 'migrateclass'])->name('migrateclass');