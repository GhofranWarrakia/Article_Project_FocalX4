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
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\RoleRequestController;
use App\Http\Controllers\AdminRoleRequestController;

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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::resource('users',Controller::class);

// Route::resource('article',ArticleController::class);

// Route::resource('category',ArticleController::class);

// Route::resource('categories', CategoryController::class);

// Route::post('/article/{id}', [ArticleController::class, 'storeWithId'])->name('article.storeWithId');
// Route::post('/article', [ArticleController::class, 'index2'])->name('article.index2');

Route::get('/article/{id}', [ArticleController::class, 'show'])->name('articles.show');
Route::post('/article/{id}/comment', [CommentController::class, 'store'])->name('comment.store');

// Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
// Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

// Route::post('article/{id}/favorite', [FavoriteController::class, 'addFavorite'])->name('article.favorite');
// Route::post('article/{id}/unfavorite', [FavoriteController::class, 'removeFavorite'])->name('article.unfavorite');

// Route::post('/favorite/{article}', [FavoriteController::class, 'store'])->name('favorite.store');
// Route::delete('/favorite/{article}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');



Route::middleware(['auth'])->group(function () {
    Route::get('/block', [BlockController::class, 'index'])->name('block.index');
    Route::post('/block/block', [BlockController::class, 'block'])->name('block.block');
    Route::post('/block/unblock', [BlockController::class, 'unblock'])->name('block.unblock');
});




Route::group(['middleware' => ['auth']], function () {
    // Route::resource('roles', RoleController::class);


    Route::resource('users',Controller::class);

    Route::resource('article',ArticleController::class);

    Route::resource('category',ArticleController::class);

    Route::resource('categories', CategoryController::class);

    Route::post('/article/{id}', [ArticleController::class, 'storeWithId'])->name('article.storeWithId');
    Route::post('/article', [ArticleController::class, 'index2'])->name('article.index2');

    Route::patch('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::post('article/{id}/favorite', [FavoriteController::class, 'addFavorite'])->name('article.favorite');
    Route::post('article/{id}/unfavorite', [FavoriteController::class, 'removeFavorite'])->name('article.unfavorite');

    Route::post('/favorite/{article}', [FavoriteController::class, 'store'])->name('favorite.store');
    Route::delete('/favorite/{article}', [FavoriteController::class, 'destroy'])->name('favorite.destroy');





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

Route::get('/role-request', [RoleRequestController::class, 'showForm'])->name('role.request.form');
Route::post('/role-request', [RoleRequestController::class, 'submitForm'])->name('role.request');

Route::get('/admin/role-requests', [AdminRoleRequestController::class, 'index'])->name('admin.role.requests');
Route::post('/admin/role-requests/{id}', [AdminRoleRequestController::class, 'handleRequest'])->name('role.request.handle');

Route::get('/{page}',  [App\Http\Controllers\AdminController::class, 'index']);

Route::delete('/users/{id}', [Controller::class, 'destroy'])->name('users.destroy');

// Route::patch('/articles/update', [ArticleController::class, 'update'])->name('articles.update');
Route::patch('/article/{test}', [ArticleController::class, 'update'])->name('article.update');

Route::delete('/articles/destroy', [ArticleController::class, 'destroy'])->name('articles.destroy');

