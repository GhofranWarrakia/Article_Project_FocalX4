<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('users',Controller::class);
Route::resource('block',BlockController::class);
Route::resource('article',ArticleController::class);
Route::resource('category',ArticleController::class);
Route::resource('categories', CategoryController::class);


Route::get('/{page}',  [App\Http\Controllers\AdminController::class, 'index']);

Route::delete('/users/{id}', [Controller::class, 'destroy'])->name('users.destroy');

Route::patch('/articles/update', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/destroy', [ArticleController::class, 'destroy'])->name('articles.destroy');

