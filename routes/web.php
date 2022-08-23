<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\BulkMailController;
use App\Http\Controllers\KlassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\ReportsController;
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
*/

Route::GET('/', function () {
    return view('front.landing');
})->middleware('guest');
Route::GET('/login', function () {
    return view('auth.login');
})->middleware('guest');

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
  // Menus
  Route::GET('dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::GET('accounts', [AccountsController::class, 'index'])->name('accounts');
  Route::GET('items', [ItemsController::class, 'items'])->name('items');
  Route::GET('classes', [KlassController::class, 'index'])->name('classes');
  Route::GET('reports', [ReportsController::class, 'index'])->name('reports');
  Route::GET('teachers', [TeachersController::class, 'teachers'])->name('teachers');
  Route::GET('students', [StudentsController::class, 'students'])->name('students');
  Route::GET('profile',  [UserController::class, 'viewprofile'])->name('profile');
  Route::GET('settings',  [SettingsController::class, 'settings'])->name('settings');

  // Profile
  Route::GET('profile/edit/{user_id}',  [UserController::class, 'editprofile'])->name('editprofile');
  Route::GET('profile/view/{user_id}',  [UserController::class, 'viewprofile'])->name('viewprofile');
  Route::POST('profile/edit',  [UserController::class, 'update'])->name('profileedit');

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
  Route::GET('report/view/{subject_id}', [ReportsController::class, 'subjectreport'])->name('subjectreport');

  // Teachers
  Route::GET('teachers/new', [TeachersController::class, 'newteacher'])->name('newteacher');
  Route::POST('employ', [TeachersController::class, 'employ'])->name('employ');
  Route::GET('/subject/{subjects_id}', [SubjectController::class, 'teacherview'])->name('teacherview');
  Route::POST('/assessment/make', [AssessmentController::class, 'create'])->name('makeassessment');
  Route::GET('/assessment/{assessment_id}', [AssessmentController::class, 'gradingview'])->name('gradingview');
  Route::POST('/assessment/addscore/{assessment_id}', [AssessmentController::class, 'addscore'])->name('addscore');
  Route::POST('delete', [TeachersController::class, 'delete'])->name('delete_teacher');

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
  Route::POST('create_admin',  [SettingsController::class, 'create_admin'])->name('create_admin');
  Route::POST('delete_admin',  [SettingsController::class, 'delete'])->name('delete_admin');
  Route::POST('edit_school_name',  [SettingsController::class, 'edit_school_name'])->name('edit_school_name');

  // Bulk Mails
  Route::GET('bulkmails', [BulkMailController::class, 'index'])->name('bulkmail');
  Route::POST('bulkmails', [BulkMailController::class, 'sendmail'])->name('sendbulkmail');
});