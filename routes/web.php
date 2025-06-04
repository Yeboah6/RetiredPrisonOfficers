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

Route::get('/dashboard', [MainController::class, 'dashboard']) -> name('dashboard') -> middleware('role');

// Super Admin only routes
Route::middleware(['role:super_admin'])->group(function () {
    Route::get('/super-admin/dashboard', [MainController::class, 'superAdmin']);
    Route::get('/super-admin/user-logs', [MainController::class, 'getUserLogs']);
    Route::get('/super-admin/users', [MainController::class, 'manageUsers']);
    Route::get('/super-admin/add-users', [MainController::class, 'addUsers']);
    Route::post('/super-admin/add-users', [MainController::class, 'postAddUsers']) -> name('add.user');
});

Route::get('/region', [MainController::class, 'region']) -> name('region') -> middleware('isLoggedIn');

Route::get('/add-region', [MainController::class, 'addRegion']) -> name('add-region') -> middleware('isLoggedIn');
Route::post('/add-region', [MainController::class, 'postAddRegion']) -> name('add-region');
Route::get('/edit-region/{id}', [MainController::class, 'editRegion']) -> name('edit-region');
Route::post('/edit-region/{id}', [MainController::class, 'postEditRegion']) -> name('edit-region');
Route::get('/delete-region/{id}', [MainController::class, 'deleteRegion']) -> name('delete-region');

Route::get('/officers', [MainController::class, 'officer']) -> name('officers') -> middleware('isLoggedIn');

Route::get('/report', [MainController::class, 'report']) -> name('report') -> middleware('isLoggedIn');


Route::get('/view/{id}', [MainController::class, 'viewOfficer']) -> name('view') -> middleware('isLoggedIn');


Route::get('/delete/{id}', [MainController::class, 'deleteOfficer']) -> name('delete') -> middleware('isLoggedIn');

Route::get('/preview', [MainController::class, 'preview']) -> name('preview');



Route::get('/get-districts/{region}', [FormController::class, 'getDistricts']);


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



Route::get('/quarterly-report', [MainController::class, 'generateQuarterlyReport'])->name('quarterly.report');
Route::get('/periodic-report', [MainController::class, 'periodicReport'])->name('periodic.report');

Route::get('/generate-quarterly-report', [MainController::class, 'newGenerateQuarterlyReport'])->name('quarterly.report');

Route::get('/etdkf', [MainController::class, 'All']);