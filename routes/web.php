<?php

use App\Http\Controllers\{
    BlogController,
    HomeController,
    PostController,
};
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

Route::get('/', [BlogController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function() {

    Route::get('/dashboard', [HomeController::class, 'index']);

    Route::get('posts', [PostController::class, 'index'])->name('posts.index');

    Route::post('posts', [PostController::class, 'store'])->name('posts.store');

    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');

});

Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');