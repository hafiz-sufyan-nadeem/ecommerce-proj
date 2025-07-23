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


        $categories = Category::orderBy('created_at', 'DESC')->paginate(5);

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
            'image' => 'required|image',

        ]);

        // Store image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('admin-images/category'), $imageName);


        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $imageName;


        $category->save();

        return redirect()->route('admin.categories')->with('success', 'Category added successfully');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|nullable',
            'image' => 'nullable|image',

        ]);

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin-images/category'), $fileName);
            $category->image = $fileName;
        }
//        $imagePath = $request->file('image')->store('images', 'public');
//        $category->image = $imagePath;



        $category->name = $request->name;
        $category->description = $request->description;

        $category->save();

        return redirect()->route('admin.categories')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $category = Category::findorFail($id);
        if ($category->image && file_exists(public_path('storage/' . $category->image))) {
            unlink(public_path('storage/' . $category->image));
        }

        $category->delete();
        return redirect()->route('admin.categories')->with('success', 'Category deleted successfully');
    }


    public function view()
    {
        $categories = Category::all();
        return view('frontend.categories.index', compact('categories'));
    }

}
