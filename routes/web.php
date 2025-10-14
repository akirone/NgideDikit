<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\IdeController;
use App\Http\Controllers\WebSettingController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);

Route::get('/profile', [UserController::class, 'profile'])->name('users.profile');

Route::resource('kategori', KategoriController::class);

Route::resource('ideas', IdeController::class)->middleware(AdminMiddleware::class);

Route::get('/settings', [WebSettingController::class, 'index'])->name('settings.index');

Route::post('/settings', [WebSettingController::class, 'updateOrCreate'])->name('settings.updateOrCreate');

Route::get('/ide', function () {
    return view('users.ide');
})->middleware('auth');

// Route::middleware(['auth'])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//     Route::get('/dashboard/user/{user}', [DashboardController::class, 'userProgress'])->name('dashboard.user.progress');
// });

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::get('/login', [AuthenticationController::class, 'index'])
    ->name('login')
    ->middleware('guest');

Route::post('/do-post', [AuthenticationController::class, 'doPost'])
    ->name('do-post')
    ->middleware('guest');

Route::post('/do-logout', [AuthenticationController::class, 'doLogout'])
    ->name('do-logout')
    ->middleware('auth');

Route::post('/do-register', [AuthenticationController::class, 'doRegister'])
    ->name('do-Register')
    ->middleware('guest');

Route::get('/register', [AuthenticationController::class, 'register'])
    ->name('register');

Route::prefix('dashboard')->middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
});
