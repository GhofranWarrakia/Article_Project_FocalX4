<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use PharIo\Manifest\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleAuthorController extends Controller
{
    public function index($article_id)
    {
        $article = Article::with('authors')->findOrFail($article_id);
        return response()->json($article->authors, 200);
    }

    public function store(Request $request, $article_id)
    {
        $article = Article::findOrFail($article_id);

        $request->validate([
            'author_id' => 'required|exists:authors,id',
        ]);

        $author = Author::findOrFail($request->author_id);
        $article->authors()->attach($author);

        return response()->json(['message' => 'Author added to article'], 201);
    }

    public function destroy($article_id, $author_id)
    {
        $article = Article::findOrFail($article_id);
        $author = Author::findOrFail($author_id);

        $article->authors()->detach($author);

        return response()->json(['message' => 'Author removed from article'], 200);
    }
}
