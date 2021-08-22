<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Customer\RedirectLocationController;
use App\Http\Controllers\User\UserProfileController;
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

Route::post('webauthn/register/options', [WebAuthnRegisterController::class, 'options'])
    ->name('webauthn.register.options');
Route::post('webauthn/register', [WebAuthnRegisterController::class, 'register'])
    ->name('webauthn.register');

Route::post('webauthn/login/options', [WebAuthnLoginController::class, 'options'])
    ->name('webauthn.login.options');
Route::post('webauthn/login', [WebAuthnLoginController::class, 'login'])
    ->name('webauthn.login');

Route::middleware(['auth:sanctum'])->group(function () {
    // Dashboard Route
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/user/security', [UserControlPanelController::class, 'showSecurity'])->middleware('password.confirm');

    // Resource Routes
    Route::resource('customers', CustomerController::class);
    Route::get('customer-location/{customerLocation}', RedirectLocationController::class)->name('customers.location');
    Route::resource('tickets', TicketController::class);

    Route::get('/users', [UserAdminController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserProfileController::class, 'show'])->name('users.profile');

    // Admin Routes
    Route::middleware(['admin'])->prefix('admin')->group(function () {
        Route::view('/dashboard', 'admin.dashboard')->name('admin.index');
        Route::get('/users', [UserAdminController::class, 'index'])->name('admin.users');
        Route::get('/navigation', [NavigationController::class, 'index'])->name('admin.navigation');
        Route::get('/permissions', [PermissionController::class, 'index'])->name('admin.permissions');
        Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles');
        Route::get('/roles/{role}', [RoleController::class, 'show'])->name('admin.roles.show');
        Route::get('/brands', [BrandController::class, 'index'])->name('admin.brands');
        Route::get('/device-types', [DeviceTypeController::class, 'index'])->name('admin.device_types');
    });
});
