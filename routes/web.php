<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    // Dashboard Route
    Route::match(['get', 'post'], '/dashboard', function(){
        return view('dashboard');
    })->name('dashboard');

    Route::get('/generate', 'NavigationGenerationController@generate');
    // User Profile Routes
    Route::get('/user/profile', 'UserController@profile')->name('user.profile');
    Route::get('/user/accounts/{status?}','UserController@accounts')->name('user.accounts');
    Route::post('/user/profile/avatar/update', 'UserController@updateAvatar')->name('user.profile.avatar.update');
    Route::post('/user/profile/avatar/delete', 'UserController@deleteAvatar')->name('user.profile.avatar.delete');

    // Resource Routes
    Route::resource('customers','CustomerController');
    Route::resource('tickets','TicketController');

    // Admin Routes
    Route::middleware(['auth','admin'])->group(function() {
        Route::view('/admin', 'admin.dashboard')->name('admin.index');
        Route::resource('admin/users','UserAdminController');
        Route::resource('admin/navigation','NavigationController');
        Route::resource('admin/brands','BrandController');
        Route::resource('admin/devicetypes','DeviceTypeController');
        Route::get('/admin/brands','BrandController@index')->name('admin.brands');
        Route::get('/admin/devicetypes','DeviceTypeController@index')->name('admin.devicetypes');
        Route::get('/admin/navtable/{id}','NavigationController@getTable');
        Route::get('/admin/order_nav/{type}/{direction}/{id}', 'NavigationController@order');
        Route::delete('/admin/navigation/child/{id}', 'NavigationController@destroyChild');
        Route::patch('/admin/navigation/child/{navigation}', 'NavigationController@updateChild');
        Route::get('/admin/json/navigation/child/{navigation}', 'NavigationController@showChild');
        Route::get('/admin/json/navigation/{navigation}', 'NavigationController@show');
        Route::get('/admin/json/navigationtype/{navigation_type}', 'NavigationTypeController@index');
    });
});
