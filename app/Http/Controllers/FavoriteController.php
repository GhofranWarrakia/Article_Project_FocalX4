<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Auth;

class FavoriteController extends Controller
{
    public function addFavorite($id)
    {
        $article = Article::find($id);
        Auth::user()->favorites()->attach($article);
        return redirect()->back()->with('success','تمت إضافة المقالة إلى المفضلة.');
    }

    public function removeFavorite($id)
    {
        $article = Article::find($id);
        Auth::user()->favorites()->detach($article);
        return redirect()->back()->with('success','تمت إزالة المقالة من المفضلة.');
    }

}
