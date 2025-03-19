<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('created_at', 'DESC')->paginate(5);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer',
            'stock' => 'required|string',
            'is_featured' => 'nullable',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('admin-images/products'), $imageName);

        $product = new Product();
        $product->name = $request->name;
        $product->image = $imageName;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->stock = $request->stock;
        $product->is_featured = $request->is_featured == 'on' ? 1 : 0;

        $product->save();

        return redirect()->route('products')->with('success', 'Product added successfully');
    }

    public function edit(Product $product)
    {
        $categories = Category::all(); // ✅ Ensure categories are available in the edit view
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer',
            'stock' => 'required|string',
            'is_featured' => 'nullable',
        ]);

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('admin-images/products'), $fileName);
            $product->image = $fileName;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->category_id = $request->category_id; // ✅ Correct column name
        $product->quantity = $request->quantity;
        $product->stock = $request->stock;
        $product->is_featured = $request->is_featured == 'on' ? 1 : 0;

        $product->save();

        return redirect()->route('products')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products')->with('success', 'Product deleted successfully!');
    }
}
