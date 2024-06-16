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

    public function store(Request $request)
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
        }

        // التحقق من التكرار قبل إنشاء المقالة
        $input = $request->all();
        $b_exists = Article::where('body', $input['body'])->exists();
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
    public function update(Request $request)
    {
        // العثور على التصنيف بناءً على اسم التصنيف
        $category = Category::where('name', $request->category_name)->first();
        if (!$category) {
            // إذا لم يتم العثور على التصنيف، ارجع برد خطأ
            session()->flash('Error', 'التصنيف غير موجود');
            return back();
        }
    
        // العثور على المقالة بناءً على معرف المقالة
        $article = Article::findOrFail($request->pro_id);
    
        // تحديث بيانات المقالة
        $article->update([
            'title' => $request->title,
            'body' => $request->body,
            'category_id' => $category->id,
        ]);
    
        session()->flash('Edit', 'تم تعديل المقالة بنجاح');
        return back();
    }
    public function destroy(Request $request)
    {
        // العثور على المقالة بناءً على معرف المقالة
        $article = Article::findOrFail($request->pro_id);
    
        // حذف المقالة
        $article->delete();
    
        session()->flash('delete', 'تم حذف المقالة بنجاح');
        return back();
    }
    
}

