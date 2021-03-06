<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\IndexController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes([
    'register' => false
]);

Route::middleware(['auth'])->group(static function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin');

    Route::get('/admin/post/search', [PostController::class, 'search'])->name('post.search');
    Route::resource('/admin/post', PostController::class);

    Route::get('/admin/comments/search', [CommentController::class, 'search'])->name('comments.search');
    Route::resource('/admin/comments', CommentController::class);

    Route::get('/admin/users/search', [UserController::class, 'search'])->name('users.search');
    Route::resource('/admin/users', UserController::class);
});

Route::get('/', [IndexController::class, 'index'])->name('front');
