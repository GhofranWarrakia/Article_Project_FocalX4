<?php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $articles = Article::all();
        $categories = Category::all();
        return view('graduation.category', compact('articles', 'categories'));
    }

    // public function create()
    // {
    //     return view('categories.create');
    // }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        session()->flash('Add', 'تمت إضافة التصنيف بنجاح');
        return redirect('/categories');
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ], [
            'name.required' => 'يرجى ادخال اسم التصنيف',
            'name.max' => 'لا يمكن ادخال اكثر من 255 حرف',
            'name.unique' => 'اسم التصنيف موجود بالفعل',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
        ]);

        session()->flash('edit', 'تم تعديل معلومات التصنيف بنجاح');
        return redirect('/categories');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        Category::findOrFail($id)->delete();

        session()->flash('delete', 'تم حذف التصنيف بنجاح');
        return redirect('/categories');
    }
}
