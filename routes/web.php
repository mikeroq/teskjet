<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\NavigationController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Admin\DeviceTypeController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\User\UserControlPanelController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LandingController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {
    // Dashboard Route
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/user/security', [UserControlPanelController::class, 'showSecurity'])->middleware('password.confirm');

    // Resource Routes
    Route::resource('customers', CustomerController::class);
    Route::resource('tickets', TicketController::class);

    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        Route::view('/', 'admin.dashboard')->name('admin.index');
        Route::resource('/users', UserAdminController::class);
        Route::resource('/navigation', NavigationController::class);
        Route::resource('/brands', BrandController::class);
        Route::resource('/device-types', DeviceTypeController::class);
        Route::get('/permissions', [PermissionController::class, 'index'])->name('admin.permissions');
        Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles');
        Route::get('/roles/{role}', [RoleController::class, 'show'])->name('admin.roles.show');
        Route::get('/brands', [BrandController::class, 'index'])->name('admin.brands');
        Route::get('/device-types', [DeviceTypeController::class, 'index'])->name('admin.device_types');
    });
});
