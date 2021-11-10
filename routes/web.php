<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
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

//Pages
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('news', [PageController::class, 'news'])->name('news');
Route::get('team', [PageController::class, 'team'])->name('team');
Route::get('contact', [PageController::class, 'contact'])->name('contact');

//Dashboard
Route::get('dashboard', [DashboardController::class, 'home'])->middleware(['auth'])->name('dashboard');
Route::get('dashboard/magazine', [DashboardController::class, 'magazine'])->middleware(['auth'])->name('dashboard.magazine');
Route::get('dashboard/users', [DashboardController::class, 'users'])->middleware(['auth'])->name('dashboard.users');
Route::get('dashboard/settings', [DashboardController::class, 'settings'])->middleware(['auth'])->name('dashboard.settings');

//Post
Route::get('post', [PostController::class, 'index'])->name('post.index');
Route::get('post/new', [PostController::class, 'create'])->name('post.create');
Route::get('post/{slug}', [PostController::class, 'show'])->name('post.show');
Route::post('post', [PostController::class, 'store'])->name('post.store');
Route::get('post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
Route::put('post/{id}', [PostController::class, 'update'])->name('post.update');
Route::get('post/publish/{id}', [PostController::class, 'publish'])->name('post.publish');

Route::get('post/tag/{name}', [PostController::class, 'tag'])->name('post.tag');
Route::post('post/img', [PostController::class, 'upload'])->name('post.img');

//Auth
require __DIR__.'/auth.php';
