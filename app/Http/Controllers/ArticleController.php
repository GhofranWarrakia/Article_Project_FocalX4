<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('category', 'user')->get();
        $categories = Category::all();
        $authors = User::all();
        return view('graduation.article', compact('articles', 'categories', 'authors'));
    }

    public function index2(Request $request)
    {
        $selectedCategory = $request->input('category_id');
        $categories = Category::all();
    
        if ($selectedCategory == 'favorites') {
         
            $articles = auth()->user()->favoriteArticles;
            if ($articles->isEmpty()) {
                $message = 'لا يوجد مقالات مفضلة';
            }
        } elseif ($selectedCategory) {
            $articles = Article::where('category_id', $selectedCategory)->get();
            if ($articles->isEmpty()) {
                $message = 'لا يوجد';
            }
        } else {
            $articles = Article::all();
        }
    
        return view('articles.index', compact('articles', 'categories', 'selectedCategory', 'message'));
    }
    

    public function storeWithId(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'user_id' => 'required|integer|exists:users,id',
            'category_id' => 'required|integer|exists:categories,id',
        ]);

        // تحميل الصورة
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
        } else {
            $name = null; // إذا لم يكن هناك صورة مرفقة
        }

        // التحقق من التكرار قبل إنشاء المقالة
        $b_exists = Article::where('body', $request->body)->exists();
        if ($b_exists) {
            session()->flash('Error', 'خطأ إن المعلومات المدخلة مكررة');
            return redirect('/article');
        }

        Article::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'body' => $request->body,
            'photo' => $name,
        ]);

        session()->flash('Add', 'تم اضافة المقالة بنجاح');
        return redirect('/article');
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        session()->flash('Add', 'تم اضافة التصنيف بنجاح');
        return redirect('/article');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'user_id' => 'required|integer|exists:users,id', // التأكد من وجود المستخدم
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // تحديث الصورة إن وجدت
        ]);

        $article = Article::findOrFail($request->pro_id);

        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $image->move($destinationPath, $name);
        } else {
            $name = $article->photo; // الحفاظ على الصورة الحالية إذا لم يتم تحديثها
        }

        $article->update([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'photo' => $name,
        ]);

        session()->flash('Edit', 'تم تعديل المقالة بنجاح');
        return back();
    }

    public function destroy(Request $request)
    {
        $article = Article::findOrFail($request->pro_id);
        $article->delete();
        session()->flash('delete', 'تم حذف المقالة بنجاح');
        return back();
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        $comments = $article->comments()->latest()->get();
        return view('graduation.show', compact('article', 'comments'));
    }
}