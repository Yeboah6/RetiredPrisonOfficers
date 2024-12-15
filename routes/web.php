<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'signIn']) -> middleware('alreadyLoggedIn');

Route::post('/login', [AuthController::class, 'login']) -> name('login');

Route::get('/profile', [AuthController::class, 'profile']) -> name('profile');
Route::post('/profile', [AuthController::class, 'postProfile']) -> name('profile');

Route::get('/logout', [AuthController::class, 'logout']) -> name('logout');

Route::get('/dashboard', [MainController::class, 'dashboard']) -> name('dashboard') -> middleware('isLoggedIn');

Route::get('/forms', [MainController::class, 'form']) -> name('forms') -> middleware('isLoggedIn');
Route::post('/forms', [MainController::class, 'postForm']) -> name('forms');

Route::get('/officers', [MainController::class, 'officer']) -> name('officers') -> middleware('isLoggedIn');

Route::get('/report', [MainController::class, 'report']) -> name('report') -> middleware('isLoggedIn');


Route::get('/view/{id}', [MainController::class, 'viewOfficer']) -> name('view') -> middleware('isLoggedIn');


Route::get('/delete/{id}', [MainController::class, 'deleteOfficer']) -> name('delete') -> middleware('isLoggedIn');

Route::get('/preview', [MainController::class, 'preview']) -> name('preview');

// Route::get('/sendmail/{id}', [MainController::class, 'sendmail']) -> name('sendmail');



Route::get('/approve/{id}', [MainController::class, 'approveOfficer']) -> name('approve') -> middleware('isLoggedIn');
Route::post('/approve/{id}', [MainController::class, 'postApproveOfficer']) -> name('approve');


Route::get('/personal-info', [FormController::class, 'personalInfo']) -> name('personal-info') -> middleware('isLoggedIn');
Route::post('/personal-info', [FormController::class, 'postPersonalInfo']) -> name('personal-info');

Route::get('/edit-personal-info/{id}', [FormController::class, 'editPersonalInfo']) -> name('edit-personal-info') -> middleware('isLoggedIn');
Route::post('/edit-personal-info/{id}', [FormController::class, 'postEditPersonalInfo']) -> name('edit-personal-info');


Route::get('/professional-info', [FormController::class, 'professionalInfo']) -> name('professional-info') -> middleware('isLoggedIn');
Route::post('/professional-info', [FormController::class, 'postProfessionalInfo']) -> name('professional-info');

Route::get('/edit-professional-info/{id}', [FormController::class, 'editProfessionalInfo']) -> name('edit-professional-info') -> middleware('isLoggedIn');
Route::post('/edit-professional-info/{id}', [FormController::class, 'postEditProfessionalInfo']) -> name('edit-professional-info');


Route::get('/others', [FormController::class, 'others']) -> name('others') -> middleware('isLoggedIn');
Route::post('/others', [FormController::class, 'postOthers']) -> name('others');

Route::get('/edit-others/{id}', [FormController::class, 'editOther']) -> name('edit-other') -> middleware('isLoggedIn');
Route::post('/edit-others/{id}', [FormController::class, 'postEditOther']) -> name('edit-other');
