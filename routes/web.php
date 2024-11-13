<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'signIn']);

Route::post('/login', [AuthController::class, 'login']) -> name('login');

Route::get('/dashboard', [MainController::class, 'dashboard']) -> name('dashboard');

