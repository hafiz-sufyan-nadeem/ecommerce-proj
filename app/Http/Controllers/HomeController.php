<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Blog;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\select;
use function Pest\Laravel\get;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch products based on the count in cart_items
        $products = DB::table('products')
            ->join('cart_items', 'products.id', '=', 'cart_items.product_id')
            ->select('products.*', DB::raw('COUNT(cart_items.id) as cart_count'))
            ->groupBy('products.id')
            ->orderBy('cart_count', 'DESC')
            ->orderBy('products.id', 'DESC') // same count then show latest
            ->limit(6)
            ->get();

        // Categories aur Blogs ko fetch karna
        $categories = DB::select("select * from categories order by id DESC LIMIT 6");
        $blogs = DB::select("select * from blogs order by id DESC");

        // Show latest products on Just Arrived section
        $just_arrived_products = DB::select("select * from products order by id DESC limit 6");

        // show only featured product whos val == 1
        $featured_products = DB::select("select * from products where is_featured = 1 order by id DESC limit 6");

        // View ko data bhejna

        return view('website.index', [
            'products' => $products,
            'categories' => $categories,
            'blogs' => $blogs,
            'just_arrived_products' => $just_arrived_products,
            'featured_products' => $featured_products,
        ]);
    }

    public function productDetail($id)
    {
        $product = Product::with('reviews.user')->find($id);

        if (!$product) {
            abort(404);
        }

        return view('website.product-detail', compact('product'));
    }

}

