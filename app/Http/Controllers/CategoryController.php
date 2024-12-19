<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index()
    {
//        $categories = category::all();

        $categories = Category::orderBy('created_at', 'DESC')->get();

        $categories = DB::table('categories')->where('id')->paginate(5);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }


    public function show()
    {
        return view('admin.categories.show');
    }

    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required',
           'description' => 'required|nullable',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;

        $category->save();

        return redirect()->route('admin.categories')->with('success', 'Category added successfully');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|nullable',
        ]);

        $category->name = $request->name;
        $category->description = $request->description;

        $category->save();

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $category = Category::findorFail($id);
        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully');
    }
}
