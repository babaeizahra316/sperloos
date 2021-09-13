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
    return 'My app is running';
});

Route::get('/post', [App\Http\Controllers\PostController::class, 'index'])->name('post.index');
Route::get('/post/create/{user}', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');
Route::post('/post/{user}', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
Route::get('/post/{post}', [App\Http\Controllers\PostController::class, 'show'])->name('post.show');
Route::get('/post/{user}/edit/{post}', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
Route::put('/post/{user}/{post}', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
Route::delete('/post/{user}/{post}', [App\Http\Controllers\PostController::class, 'destroy'])->name('post.destroy');




