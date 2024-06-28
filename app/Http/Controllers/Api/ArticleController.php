<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    //تصفح مقالات
    public function index()
    {
        $articles = Article::with('author')->get();
        return response()->json($articles, 200);
    }
}
