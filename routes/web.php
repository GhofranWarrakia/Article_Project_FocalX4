<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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

// Route::resource('block',BlockController::class);
Route::resource('article',ArticleController::class);

Route::resource('category',ArticleController::class);

Route::resource('categories', CategoryController::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/block', [BlockController::class, 'index'])->name('block.index');
    Route::post('/block/block', [BlockController::class, 'block'])->name('block.block');
    Route::post('/block/unblock', [BlockController::class, 'unblock'])->name('block.unblock');
});




Route::group(['middleware' => ['auth']], function () {
    // Route::resource('roles', RoleController::class);
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('roles/{role}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    // Route::resource('users', Controller::class)->middleware('role:admin'); // Example middleware usage
    Route::resource('users', Controller::class); // Example middleware usage

});

Route::get('/{page}',  [App\Http\Controllers\AdminController::class, 'index']);

Route::delete('/users/{id}', [Controller::class, 'destroy'])->name('users.destroy');

// Route::patch('/articles/update', [ArticleController::class, 'update'])->name('articles.update');
Route::patch('/article/{test}', [ArticleController::class, 'update'])->name('article.update');

Route::delete('/articles/destroy', [ArticleController::class, 'destroy'])->name('articles.destroy');

