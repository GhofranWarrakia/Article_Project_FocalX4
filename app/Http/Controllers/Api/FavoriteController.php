<?php

namespace App\Http\Controllers\Api;

use App\Models\Favorite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoriteController extends Controller
{
    //إضافة مقالة إلى المفضلة
    public function store(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
        ]);

        $favorite = new Favorite();
        $favorite->user_id = auth()->user()->id;
        $favorite->article_id = $request->article_id;
        $favorite->save();

        return response()->json(['message' => 'Article added to favorites'], 201);
    }
}
