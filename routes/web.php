<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\ProjectController;
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
})->name('home');

Route::post('login', [LoginController::class, 'index'])->name('login.submit');

Route::group(['middleware' => 'auth'], function() {

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::group(['prefix' => 'projects', 'as' => 'projects::'], function() {
        Route::get('/', [ProjectController::class, 'index'])->name('index');
        Route::post('/', [ProjectController::class, 'store'])->name('store');
        Route::get('/{project}', [ProjectController::class, 'show'])->name('show');
        Route::get('/{project}/edit', [ProjectController::class, 'edit'])->name('edit');
        Route::put('/{project}/edit', [ProjectController::class, 'update'])->name('update');
        Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('destroy');

        Route::group(['as' => 'monitors::', 'prefix' => '{project}/monitors'], function() {
            Route::get('/create', [MonitorController::class, 'create'])->name('create');
            Route::post('/create', [MonitorController::class, 'store'])->name('store');
            Route::get('/{monitor}', [MonitorController::class, 'show'])->name('show');
            Route::get('/{monitor}/edit', [MonitorController::class, 'edit'])->name('edit');
            Route::put('/{monitor}/edit', [MonitorController::class, 'update'])->name('update');
            Route::delete('/{monitor}', [MonitorController::class, 'destroy'])->name('destroy');
        });
    });
});
