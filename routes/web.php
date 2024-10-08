<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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

/* home */
Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});

/* Admin */
Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin/dashboard', 'index')->name('admin.index');
    });
});

/* User */
Route::resource('user', UserController::class)->only([
    'index','destroy'
]);


Route::resource('contact', \App\Http\Controllers\ContactController::class)->only([
    'index', 'create', 'store', 'edit', 'update', 'destroy'
]);

Route::resource('department', \App\Http\Controllers\DepartmentController::class)->only([
    'index', 'create', 'store', 'edit', 'update', 'destroy'
]);

Route::match(['get', 'post'], '/contacts/search', 'App\Http\Controllers\AdminController@search')->name('contacts.search');

/* import/export */
Route::get('/contacts/export', 'App\Http\Controllers\AdminController@exportContacts')->name('contacts.export');
Route::post('/contacts/import', 'App\Http\Controllers\AdminController@importContacts')->name('contacts.import');



/* jetstream auth */
//Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
//    Route::get('/dashboard', function () {
//        return view('dashboard');
//    })->name('dashboard');
//});

