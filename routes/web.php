<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'signIn']);

Route::post('/login', [AuthController::class, 'login']) -> name('login');

Route::get('/logout', [AuthController::class, 'logout']) -> name('logout');

Route::get('/dashboard', [MainController::class, 'dashboard']) -> name('dashboard') -> middleware('isLoggedIn');

Route::get('/forms', [MainController::class, 'form']) -> name('forms') -> middleware('isLoggedIn');
Route::post('/forms', [MainController::class, 'postForm']) -> name('forms');

Route::get('/officers', [MainController::class, 'officer']) -> name('officers') -> middleware('isLoggedIn');

Route::get('/view/{id}', [MainController::class, 'viewOfficer']) -> name('view') -> middleware('isLoggedIn');


Route::get('/delete/{id}', [MainController::class, 'deleteOfficer']) -> name('delete') -> middleware('isLoggedIn');

Route::get('/edit/{id}', [MainController::class, 'editOfficer']) -> name('edit') -> middleware('isLoggedIn');
Route::post('/edit/{id}', [MainController::class, 'postEditOfficer']) -> name('edit');


Route::get('/approve/{id}', [MainController::class, 'approveOfficer']) -> name('approve') -> middleware('isLoggedIn');
Route::post('/approve/{id}', [MainController::class, 'postApproveOfficer']) -> name('approve');


