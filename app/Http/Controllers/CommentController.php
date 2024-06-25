<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $article_id = $request->input('article_id');
        $validated = $request->validate([
            'comment' => 'required|string',
        ]);
        $user_id = auth()->user()->id;

        // إنشاء تعليق جديد
        $comment = new Comment();
        $comment->comment = $request->comment;
        $comment->article_id = $article_id;
        $comment->user_id = $user_id;
        $comment->save();

        return redirect()->back()->with('success', 'تمت إضافة التعليق بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'comment' => 'required|string',
            
        ]);
    
        $comment = Comment::findOrFail($id);
        $comment->update([
            'comment' => $request->comment,
        ]);
    
        return redirect()->back()->with('success', 'تم تحديث التعليق بنجاح.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Comment $comment = null) 
    {
        $comment->delete();

        return redirect()->back()->with('success', 'تم حذف التعليق بنجاح.');
    }
}
