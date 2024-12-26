<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'DESC')->paginate(5);

        return view('admin.blogs.index', compact('blogs'));

    }

    public function create()
    {
        $blogs = Blog::all();

        return view('admin.blogs.create', compact('blogs'));
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    public function show()
    {
        return view('/admin/blogs/show');
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
        $request->image->move(public_path('admin-images/blog'), $imageName);


        $blog = new Blog();
        $blog->name = $request->name;
        $blog->description = $request->description;
        $blog->image = $imageName;


        $blog->save();

        return redirect()->route('admin.blogs')->with('success', 'Blog added successfully');
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|nullable',
            'image' => 'nullable|image',

        ]);

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin-images/blog'), $fileName);
            $blog->image = $fileName;
        }

        $blog->name = $request->name;
        $blog->description = $request->description;

        $blog->save();

        return redirect()->route('admin.blogs')->with('success', 'Blog updated successfully');
    }


    public function destroy($id)
    {
        $blog = Blog::findorFail($id);
        if ($blog->image && file_exists(public_path('storage/' . $blog->image))) {
            unlink(public_path('storage/' . $blog->image));
        }

        $blog->delete();
        return redirect()->route('admin.blogs')->with('success', 'Blog deleted successfully');
    }
}
