<?php

namespace App\Http\Controllers\Api;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Article2Controller extends Controller
{
    public function index()
    {
        $articles = Article::all();
        return response()->json($articles, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'photo' => 'sometimes|file',
            'category_id' => 'required|integer|exists:categories,id',
            'author_id' => 'required|integer|exists:authors,id',
        ]);

        $article = new Article();
        $article->title = $request->title;
        $article->body = $request->body;
        $article->category_id = $request->category_id;
        $article->author_id = $request->author_id;

        if ($request->hasFile('photo')) {
            $article->photo = $request->file('photo')->store('images');
        }

        $article->save();

        return response()->json(['message' => 'تم اضافة المقالة'], 201);
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'body' => 'sometimes|required|string',
            'photo' => 'sometimes|file',
            'category_id' => 'sometimes|required|integer|exists:categories,id',
            'author_id' => 'sometimes|required|integer|exists:authors,id',
        ]);

        if ($request->has('title')) {
            $article->title = $request->title;
        }

        if ($request->has('body')) {
            $article->body = $request->body;
        }

        if ($request->has('category_id')) {
            $article->category_id = $request->category_id;
        }

        if ($request->has('author_id')) {
            $article->author_id = $request->author_id;
        }

        if ($request->hasFile('photo')) {
            $article->photo = $request->file('photo')->store('images');
        }

        $article->save();

        return response()->json(['message' => 'تم تعديل المقالة بنجاح'], 200);
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json(['message' => 'تم حذف المقالة بنجاح'], 200);
    }
}
