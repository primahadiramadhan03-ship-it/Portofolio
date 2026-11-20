<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

// === AUTENTIKASI ===
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// === HALAMAN UTAMA (FRONTEND) ===
Route::get('/', [PortfolioController::class, 'index'])->name('home');
Route::post('/send-message', [PortfolioController::class, 'sendContact'])->name('contact.send');

// === ADMIN DASHBOARD (BACKEND - PROTECTED) ===
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    Route::post('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::post('/homepage', [AdminController::class, 'updateHomepage'])->name('homepage.update');
    Route::post('/about', [AdminController::class, 'updateAbout'])->name('about.update');
    
    // Skills Management
    Route::post('/skills', [AdminController::class, 'storeSkill'])->name('skills.store');
    Route::put('/skills/{id}', [AdminController::class, 'updateSkill'])->name('skills.update');
    Route::delete('/skills/{id}', [AdminController::class, 'deleteSkill'])->name('skills.delete');
    
    // Portfolio Management
    Route::post('/portfolio', [AdminController::class, 'storePortfolio'])->name('portfolio.store');
    Route::put('/portfolio/{id}', [AdminController::class, 'updatePortfolio'])->name('portfolio.update');
    Route::delete('/portfolio/{id}', [AdminController::class, 'deletePortfolio'])->name('portfolio.delete');
    
    // Contact & Message Management
    Route::post('/contact', [AdminController::class, 'updateContact'])->name('contact.update');
    Route::delete('/message/{id}', [AdminController::class, 'deleteMessage'])->name('message.delete');
});
