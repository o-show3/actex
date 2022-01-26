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
    Route::post('/pair/like', [\App\Http\Controllers\PairActionController::class, 'like'])->name('pair-like');
    Route::post('/pair/none', [\App\Http\Controllers\PairActionController::class, 'none'])->name('pair-none');
});
Route::prefix('category')->name('category.')->group(function () {
    Route::get('/', \App\Http\Controllers\CategoryController::class)->name('top');
    Route::post('/add', \App\Http\Controllers\CategoryPostController::class)->name('add');
});
Route::prefix('topics')->name('topics.')->group(function () {
    Route::get('/', \App\Http\Controllers\TopicController::class)->name('top');
});
Route::prefix('message')->name('message.')->group(function () {
    Route::get('/', \App\Http\Controllers\MessageListController::class)->name('top');
    Route::get('/room/{pairing_user_id}', \App\Http\Controllers\MessageRoomController::class)->name('room');
    Route::post('/room/{pairing_user_id}', \App\Http\Controllers\MessageRoomPostMessageController::class)->name('room-post-message');
    Route::post('/room/{pairing_user_id}/file', \App\Http\Controllers\MessageRoomPostFileController::class)->name('room-post-file');
});



// 管理用
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/pair', \App\Http\Controllers\Admin\PairController::class)->name('pair');
    });
});


require __DIR__.'/auth.php';
