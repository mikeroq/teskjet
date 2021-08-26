<?php

use App\Http\Controllers\Admin\BrandIndexController;
use App\Http\Controllers\Admin\DeviceTypeIndexController;
use App\Http\Controllers\Admin\NavigationIndexController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PermissionIndexController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserAdminIndexController;
use App\Http\Controllers\Customer\RedirectLocationController;
use App\Http\Controllers\LandingRedirectController;
use App\Http\Controllers\TestController;
use App\Http\Livewire\User\Profile;
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

Route::get('/', LandingRedirectController::class);


Route::middleware(['auth:sanctum'])->group(function () {
    // Dashboard Route
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/test', [TestController::class, 'index']);
    Route::post('/test', [TestController::class, 'create'])->name('test.create');

    Route::get('/user/security', [UserControlPanelController::class, 'showSecurity'])->middleware('password.confirm');

    // Resource Routes
    Route::resource('customers', CustomerController::class);
    Route::get('customer-location/{customerLocation}', RedirectLocationController::class)->name('customers.location');
    Route::resource('tickets', TicketController::class);
    Route::get('/users', UserAdminIndexController::class)->name('users.index');
    Route::get('/users/{user}', Profile::class)->name('users.profile');

    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        Route::view('/dashboard', 'admin.dashboard')->name('admin.index');
        Route::get('/users', UserAdminIndexController::class)->name('admin.users');
        Route::get('/navigation', NavigationIndexController::class)->name('admin.navigation');
        Route::get('/permissions', PermissionIndexController::class)->name('admin.permissions');
        Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles');
        Route::get('/roles/{role}', [RoleController::class, 'show'])->name('admin.roles.show');
        Route::get('/brands', BrandIndexController::class)->name('admin.brands');
        Route::get('/device-types', DeviceTypeIndexController::class)->name('admin.device_types');
    });
});
