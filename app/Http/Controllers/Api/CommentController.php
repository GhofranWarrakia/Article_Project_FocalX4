<?php

namespace App\Http\Controllers\Api;

use PhpParser\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    //إضافة تعليق على مقالة
    public function store(Request $request, $article_id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->article_id = $article_id;
        $comment->content = $request->content;
        $comment->save();

        return response()->json(['message' => 'Comment added'], 201);
    }
}
