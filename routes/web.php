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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// ユーザ用
Route::prefix('users')->name('users.')->group(function () {
    Route::get('/pair', \App\Http\Controllers\PairController::class)->name('pair');
});
Route::get('/category', \App\Http\Controllers\CategoryController::class)->name('category');


// 管理用
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/pair', \App\Http\Controllers\Admin\PairController::class)->name('pair');
    });
});


require __DIR__.'/auth.php';
