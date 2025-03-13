<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(5);

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:225|unique:categories,category_name',
            'description'   => 'nullable|string|max:225',
        ]);

        $category = Category::create([
            'user_id'       => auth()->id(),
            'category_name' => $request->category_name,
            'slug'          => Str::slug($request->category_name),
            'description'   => $request->description,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success'  => true,
                'category' => $category,
            ]);
        }

        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $category = Category::query()->find($id);

        return view('categories.update', compact('category'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:225|unique:categories,category_name,'.$id,
            'description'   => 'nullable|string|max:225',
        ]);

        $category = Category::find($id);
        $category->update([
            'category_name' => $request->category_name,
            'slug'          => Str::slug($request->category_name),
            'description'   => $request->description,
        ]);

        return redirect()->route('category.index');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Kategori başarıyla silindi.');
    }
}
