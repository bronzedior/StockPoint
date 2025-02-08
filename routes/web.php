<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatalogController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Register
Route::get('/register', [AuthController::class, 'ShowRegisterForm'])->name('register');

Route::post('/register', [AuthController::class, 'Register'])->name('registerSubmit');

// Login
Route::get('/login',[AuthController::class, 'ShowLoginForm'])->name('login');

Route::post('/login',[AuthController::class, 'Login'])->name('loginSubmit');

// Logout
Route::get('/logout', [AuthController::class, 'Logout'])->name('logout');

// Catalog
Route::get('/catalog', [CatalogController::class, 'ShowCatalogForm'])->name('catalog')->middleware(['isLogin']);
