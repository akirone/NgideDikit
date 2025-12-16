<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KatController;
use App\Http\Controllers\IdeController;
use App\Http\Controllers\IdeasController;
use App\Http\Controllers\WebSettingController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BoredApiController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return view('welcome');
});

// Bored API Proxy Route
Route::get('/api/bored-ideas', [BoredApiController::class, 'getMultipleIdeas'])->name('api.bored.ideas');

Route::resource('users', UserController::class);

Route::resource('kategori', KategoriController::class)->middleware(AdminMiddleware::class);

// Export Import Routes untuk Ide (harus SEBELUM resource route)
Route::get('/ide/export-excel', [IdeasController::class, 'exportExcel'])->name('ide.export.excel')->middleware('auth');
Route::get('/ide/export-pdf', [IdeasController::class, 'exportPdf'])->name('ide.export.pdf')->middleware('auth');
Route::post('/ide/import', [IdeasController::class, 'import'])->name('ide.import')->middleware('auth');
Route::post('/ide/{id}/toggle-favorite', [IdeasController::class, 'toggleFavorite'])->name('ide.toggleFavorite')->middleware('auth');

// Export Import Routes untuk Kategori (harus SEBELUM resource route)
Route::get('/kat/export-excel', [KatController::class, 'exportExcel'])->name('kat.export.excel')->middleware('auth');
Route::get('/kat/export-pdf', [KatController::class, 'exportPdf'])->name('kat.export.pdf')->middleware('auth');
Route::post('/kat/import', [KatController::class, 'import'])->name('kat.import')->middleware('auth');

Route::resource('kat', KatController::class)->middleware('auth');

Route::resource('ideas', IdeController::class)->middleware(AdminMiddleware::class);

Route::resource('ide', IdeasController::class)->middleware('auth');

Route::get('/settings', [WebSettingController::class, 'index'])->name('settings.index');

Route::post('/settings', [WebSettingController::class, 'updateOrCreate'])->name('settings.updateOrCreate');

Route::post('/ideas/{id}/toggle-favorite', [IdeController::class, 'toggleFavorite'])->name('ideas.toggleFavorite');

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
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});
