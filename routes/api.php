<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pi\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\Article2Controller;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\AuthorRequestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register',[AuthController::class,'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//تصفح مقالة
Route::get('/articles', [ArticleController::class, 'index']);
//مستخدم عادي يضيف للمفضلة
Route::post('/favorites', [FavoriteController::class, 'store'])->middleware('auth:sanctum');
//إضافة تعليق على مقالة
Route::post('/articles/{article_id}/comments', [CommentController::class, 'store'])->middleware('auth:sanctum');

//تقديم طلب تعريف حساب كاتب
Route::post('/author-request', [AuthorRequestController::class, 'store'])->middleware('auth:sanctum');
//إدارة المستخدمين للمدير
Route::apiResource('users', UserController::class)->middleware('auth:sanctum', 'admin');
//ادارة المقالات
Route::apiResource('articles', Article2Controller::class)->middleware('auth:sanctum', 'admin');

//ادارة كتّاب المقالات
Route::get('/articles/{article_id}/authors', [ArticleAuthorController::class, 'index'])->middleware('auth:sanctum', 'admin');
Route::post('/articles/{article_id}/authors', [ArticleAuthorController::class, 'store'])->middleware('auth:sanctum', 'admin');
Route::delete('/articles/{article_id}/authors/{author_id}', [ArticleAuthorController::class, 'destroy'])->middleware('auth:sanctum', 'admin');



