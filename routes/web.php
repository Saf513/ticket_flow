<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
Route::get('/admin/invite', [AdminController::class, 'showFormInvite'])->name('admin.invite');
Route::get('/login', [UserController::class, 'showLogin'])->name('login');
Route::post('/login/store', [UserController::class, 'login'])->name('login.store');
Route::get('/reset_password', [UserController::class, 'showResetPassword'])->name('reset_password');
Route::post('/admin/sendInvitation', [AdminController::class, 'sendInvitation'])->name('admin.sendInvitation');
Route::get('/register', [UserController::class, 'showRegistrationForm'])
    ->name('register')
    ->middleware('guest');

Route::post('/register/store', [UserController::class, 'register'])
    ->name('register.store')
    ->middleware('guest');
Route::post('/logout',[UserController::class , 'logout'])->name('logout');