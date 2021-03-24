<?php

use GuzzleHttp\Psr7\AppendStream;
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

// Route::get('/', function () {
//     return view('home');
// });

Route::get('/myposts', [App\Http\Controllers\PostController::class, 'mypost'])->name('mypost');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::POST('/users/research',[App\Http\Controllers\PostController::class,'filterusers'])->name("filterusers");
Route::get('/users/research',[App\Http\Controllers\PostController::class,'filterusers'])->name("filterusers");
Route::get('/posts/archive',[App\Http\Controllers\PostController::class,'archive'])->name("archive");
Route::get('/users/archive',[App\Http\Controllers\PostController::class,'usersrchive'])->name("usersrchive");
Route::PATCH('/posts/{id}/restore',[App\Http\Controllers\PostController::class,'restore'])->name("restore");
Route::PATCH('/users/{id}/restore',[App\Http\Controllers\PostController::class,'restoreuser'])->name("restoreuser");
Route::DELETE('/posts/{id}/fdelete',[App\Http\Controllers\PostController::class,'forcedelete'])->name("forcedelete");
Route::DELETE('/users/{id}/fdelete',[App\Http\Controllers\PostController::class,'forcedeleteuser'])->name("forcedeleteuser");
Route::get('/posts/all',[App\Http\Controllers\PostController::class,'all'])->name("all");
Route::get('/users',[App\Http\Controllers\PostController::class,'users'])->name("users");

Route::DELETE('/users/{user}/destroy',[App\Http\Controllers\PostController::class,'destroyuser'])->name("destroyuser");
Route::resource('/posts',App\Http\Controllers\PostController::class);

Auth::routes();

