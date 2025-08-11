<?php

use App\Exports\ShortUrlExport;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ShortUrlController;
use Illuminate\Support\Facades\Route;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('welcome');
});

Route::get('s/{token}', [ShortUrlController::class, 'redirect_to_original'])->name('shorturl.redirect');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard/{tab?}', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
    Route::post('dashboard/inviteclient', [DashboardController::class, 'inviteclient'])->name('dashboard.inviteclient');
    Route::post('dashboard/shorturl', [ShortUrlController::class, 'create_shorturl'])->name('create_shorturl');

    Route::get('/dashboard/shorturl/all', [DashboardController::class, 'shorturl_all'])->middleware(['auth', 'verified'])->name('dashboard.shorurl_all');
    
    Route::get('/export-shorturl', [ShortUrlController::class, 'export'])->name('export-shorturl');

    Route::resource('roles', RoleController::class);
});
