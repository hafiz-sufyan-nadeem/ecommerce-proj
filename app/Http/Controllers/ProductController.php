<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create(){
        return view('/admin/products/create');
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
            'category' => 'required|string',
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
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->stock = $request->stock;
        $product->save();

        return redirect()->route('admin.products')->with('success', 'Product added successfully');
    }

}
