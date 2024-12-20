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


    public function create(){
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function show()
    {
        return view('/admin/products/show');
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required',
            'image' => 'required|image',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'quantity' => 'required|integer',
            'stock' => 'required|string',
        ]);

        // Store image
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        // Save product
        $product = new Product();
        $product->name = $request->name;
        $product->image = $imageName;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->quantity = $request->quantity;
        $product->stock = $request->stock;

        $product->save();

        return redirect()->route('products')->with('success', 'Product added successfully');
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit',compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image',
            'price' => 'required|numeric',
            'category' => 'required|string',
            'quantity' => 'required|integer',
            'stock' => 'required|string',
        ]);

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $fileName);
            $product->image = $fileName;
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->stock = $request->stock;

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
