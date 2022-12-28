<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermissionsController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth', 'permission']], function() {
      /**
     * User Routes
     */
    // Route::group(['prefix' => 'users'], function() {
    //     Route::get('/', 'UsersController@index')->name('users.index');
    //     Route::get('/create', 'UsersController@create')->name('users.create');
    //     Route::post('/create', 'UsersController@store')->name('users.store');
    //     Route::get('/{user}/show', 'UsersController@show')->name('users.show');
    //     Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
    //     Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
    //     Route::delete('/{user}/delete', 'UsersController@destroy')->name('users.destroy');
    // });
    Route::resource('users', UsersController::class);
    
    // Route::patch('permissions', [PermissionsController::class, 'update'])->name('permissions.update');
    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);
});

require __DIR__.'/auth.php';
