<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AdminController;


Route::get('/', [HomeController::class, 'index'])->middleware('auth');
Route::prefix('/admin')->group(function() {
    
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::get('/login', [AdminController::class, 'login'])->name('login');
    Route::post('/login', [AdminController::class, 'loginAction']);

    Route::get('/register', [AdminController::class, 'register'])->name('register');
    Route::post('/register', [AdminController::class, 'registerAction']);
    
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::get('/{slug}/links', [AdminController::class, 'pageLinks'])->name('pages.links');
    Route::get('/{slug}/design', [AdminController::class, 'pageDesign'])->name('pages.design');
    Route::get('/{slug}/estatisticas', [AdminController::class, 'pageStats'])->name('pages.stats');

});

Route::get('/{slug}', [PageController::class, 'index']);