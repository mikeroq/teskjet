<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DeviceTypeController;
use App\Http\Controllers\NavigationGenerationController;
use App\Http\Controllers\UserAdminController;
use App\Http\Controllers\NavigationTypeController;
use App\Http\Controllers\LandingController;
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
    Route::match(['get', 'post'], '/dashboard', function(){
        return view('dashboard');
    })->name('dashboard');

    Route::get('/generate', [NavigationGenerationController::class, 'generate']);

    // Resource Routes
    Route::resource('customers',CustomerController::class);
    Route::resource('tickets',TicketController::class);

    // Admin Routes
    Route::middleware(['auth','admin'])->group(function() {
        Route::view('/admin', 'admin.dashboard')->name('admin.index');
        Route::resource('admin/users',UserAdminController::class);
        Route::resource('admin/navigation',NavigationController::class);
        Route::resource('admin/brands',BrandController::class);
        Route::resource('admin/devicetypes',DeviceTypeController::class);
        Route::get('/admin/brands',[BrandController::class, 'index'])->name('admin.brands');
        Route::get('/admin/devicetypes',[DeviceTypeController::class, 'index'])->name('admin.devicetypes');
        Route::get('/admin/navtable/{id}',[NavigationController::class, 'getTable']);
        Route::get('/admin/order_nav/{type}/{direction}/{id}', [NavigationController::class, 'order']);
        Route::delete('/admin/navigation/child/{id}', [NavigationController::class, 'destroyChild']);
        Route::patch('/admin/navigation/child/{navigation}', [NavigationController::class, 'updateChild']);
        Route::get('/admin/json/navigation/child/{navigation}', [NavigationController::class, 'showChild']);
        Route::get('/admin/json/navigation/{navigation}', [NavigationController::class, 'show']);
        Route::get('/admin/json/navigationtype/{navigation_type}', [NavigationTypeController::class, 'index']);
    });
});
