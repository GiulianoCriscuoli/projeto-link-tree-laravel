<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;


Route::get('/', [HomeController::class, 'index']);
Route::prefix('/admin')->group(function() {
    
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/login', [AdminController::class, 'login'])->name('login');
    Route::post('/login', [AdminController::class, 'loginAction']);

    Route::get('/register', [AdminController::class, 'register'])->name('register');
    Route::post('/register', [AdminController::class, 'registerAction']);
    
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
    
});

Route::get('/{slug}', [PageController::class, 'index']);