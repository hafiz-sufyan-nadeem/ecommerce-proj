<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Blog;
use App\Models\CartItem;
use Illuminate\Support\Facades\DB;
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

        // View ko data bhejna

        return view('website.index', [
            'products' => $products,
            'categories' => $categories,
            'blogs' => $blogs
        ]);
    }
}

