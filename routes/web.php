<?php

use App\Http\Controllers\AdminController;
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
Route::get('/catalog', [CatalogController::class, 'showCatalogForm'])->name('catalog')->middleware(['isLogin']);

// Admin
Route::middleware(['isLogin', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'showAdminDashboard'])->name('admin');
    Route::post('/admin/add', [CatalogController::class, 'store'])->name('store');
    Route::get('/admin/insert', [CatalogController::class, 'addItem'])->name('addItem');
    Route::put('/admin/update/{id}', [CatalogController::class, 'update'])->name('update');
    Route::get('/admin/edit/{id}', [CatalogController::class, 'editItem'])->name('editItem');
    Route::delete('/admin/delete/{id}', [CatalogController::class, 'deleteItem'])->name('deleteItem');
});


