<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\NavigationController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Admin\DeviceTypeController;
use App\Http\Controllers\Admin\UserAdminController;
use App\Http\Controllers\Admin\NavigationTypeController;
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

Route::get('/users-table', function () {
    return view('userstable');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
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
        Route::resource('/devicetypes', DeviceTypeController::class);
        Route::get('/brands', [BrandController::class, 'index'])->name('admin.brands');
        Route::get('/devicetypes', [DeviceTypeController::class, 'index'])->name('admin.devicetypes');
        Route::get('/navtable/{id}', [NavigationController::class, 'getTable']);
        Route::get('/order_nav/{type}/{direction}/{id}', [NavigationController::class, 'order']);
        Route::delete('/navigation/child/{id}', [NavigationController::class, 'destroyChild']);
        Route::patch('/navigation/child/{navigation}', [NavigationController::class, 'updateChild']);
        Route::get('/json/navigation/child/{navigation}', [NavigationController::class, 'showChild']);
        Route::get('/json/navigation/{navigation}', [NavigationController::class, 'show']);
        Route::get('/json/navigationtype/{navigation_type}', [NavigationTypeController::class, 'index']);
    });
});
