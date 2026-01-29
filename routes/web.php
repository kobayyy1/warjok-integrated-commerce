<?php

use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Admin\HeroVideoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\admin\promoController as AdminPromoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\homeKoprollController;
use App\Http\Controllers\mieayamController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ropangController;
use App\Http\Controllers\userAuthController;
use Illuminate\Support\Facades\Route;

// ========================================
// PUBLIC ROUTES (Tidak perlu login)
// ========================================
Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/home', [HomeController::class, 'home'])->name('home');
Route::get('/home/koproll', [homeKoprollController::class, 'koprol'])->name('homeKoproll');
Route::get('/home/mieayam', [mieayamController::class, 'mieayam'])->name('home.mieayam');
Route::get('/home/ropang', [ropangController::class, 'ropang'])->name('home.ropang');

// ========================================
// AUTHENTICATION ROUTES
// ========================================
Route::get('/promo', function () {
    return view('promo');
})->name('promo.index');

Route::get('/promo/user', [AdminPromoController::class, 'index'])->name('admin.promo.index');


// Login Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.store');
Route::get('/login/store', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login/user', [userAuthController::class, 'showLogin'])->name('login.user');
Route::post('/login/post', [userAuthController::class, 'login'])->name('login.post');
Route::post('/login/post', [AuthController::class, 'login'])->name('login.post');

// Register Routes
Route::get('/register', [userAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [userAuthController::class, 'register'])->name('register.post');

// Logout Route (harus sudah login)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::post('/logout', [userAuthController::class, 'logout'])->name('logout')->middleware('auth');
// ========================================
// ADMIN ROUTES (Harus login)
// ========================================
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Products Management
    Route::get('/Product', [ProductController::class, 'index'])->name('products.index');
    Route::get('/Product/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/Product', [ProductController::class, 'store'])->name('products.store');
    Route::get('/Product/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/Product/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/Product/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/Product/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    
    // Banners Management
    Route::get('/banners', [AdminBannerController::class, 'index'])->name('banners.index');
    Route::get('/banners/create', [AdminBannerController::class, 'create'])->name('banners.create');
    Route::post('/banners', [AdminBannerController::class, 'store'])->name('banners.store');
    Route::get('/banners/{banner}', [AdminBannerController::class, 'show'])->name('banners.show');
    Route::get('/banners/{banner}/edit', [AdminBannerController::class, 'edit'])->name('banners.edit');
    Route::put('/banners/{banner}', [AdminBannerController::class, 'update'])->name('banners.update');
    Route::delete('/banners/{banner}', [AdminBannerController::class, 'destroy'])->name('banners.destroy');
    Route::patch('/banners/{banner}/toggle-status', [AdminBannerController::class, 'toggleStatus'])->name('banners.toggle-status');

    // Promos Management
    // Route::resource('promos', PromoController::class);

    // Hero Videos Management
    Route::resource('hero-videos', HeroVideoController::class);
    Route::patch('hero-videos/{heroVideo}/toggle-active', [HeroVideoController::class, 'toggleActive'])
        ->name('hero-videos.toggle-active');
});