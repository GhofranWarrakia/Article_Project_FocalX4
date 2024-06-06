<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
        
    public function index()
    {
        return view ('graduation.article');
    }

    public function store(Request $request)
    {   
        // return $request;

        $input = $request->all();

        $b_exists = Article::where('body', '=', $input['body'])->exists();
    if($b_exists){
        session()->flash('Error', 'خطأ إن المعلومات المدخلة مكررة ');
        return redirect('block');
    } 

    $user = new Article();
    $user->title = $request->title;
    $user->body = $request->body;
    $user->photo = $request->photo;

    $user->save();

    return redirect()->route('article.store');
}
}