<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'signIn']);

Route::post('/login', [AuthController::class, 'login']) -> name('login');

Route::get('/logout', [AuthController::class, 'logout']) -> name('logout');

Route::get('/dashboard', [MainController::class, 'dashboard']) -> name('dashboard');

Route::get('/forms', [MainController::class, 'form']) -> name('forms');
Route::post('/forms', [MainController::class, 'postForm']) -> name('forms');

Route::get('/officers', [MainController::class, 'officer']) -> name('officers');

Route::get('/view/{id}', [MainController::class, 'viewOfficer']) -> name('view');


Route::get('/delete/{id}', [MainController::class, 'deleteOfficer']) -> name('delete');

Route::get('/edit/{id}', [MainController::class, 'editOfficer']) -> name('edit');
Route::post('/edit/{id}', [MainController::class, 'postEditOfficer']) -> name('edit');




