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
    public function index(Request $request)
    {
        $bestselling_products = Product::select(
            'products.*',
            DB::raw('SUM(order_items.quantity) as total_sold')
        )
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->limit(6)
            ->get();

        /* -------- MOST‑POPULAR -------- */
        $most_popular_products = Product::withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->orderByDesc('reviews_count')
            ->limit(6)
            ->get();



        // Categories aur Blogs ko fetch karna
        $categories = DB::select("select * from categories order by id DESC LIMIT 6");
        $blogs = DB::select("select * from blogs order by id DESC");

        // Show latest products on just Arrived section
        $just_arrived_products = Product::withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->orderBy('id', 'DESC')
            ->limit(6)
            ->get();

        // show only featured product whos val == 1
        $featured_products = Product::withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->where('is_featured', 1)
            ->orderBy('id', 'DESC')
            ->limit(6)
            ->get();

        return view('website.index', [
            'products' => $bestselling_products,
            'most_popular_products' => $most_popular_products,
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

    public function featuredProducts()
    {
        $products = Product::where('is_featured', 1)
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->orderByDesc('id')
            ->paginate(12);

        return view('website.featured-products', compact('products'));
    }

    public function bestSellingProducts()
    {
        $products = Product::select('products.*', DB::raw('SUM(order_items.quantity) as total_sold'))
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->paginate(12);

        return view('website.best-selling', compact('products'));
    }
    public function mostPopularProducts()
    {
        $products = Product::withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->orderByDesc('reviews_avg_rating')
            ->paginate(9);

        return view('website.most-popular', compact('products'));
    }

    public function justArrivedProducts()
    {
        $products = Product::withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->orderBy('id', 'DESC')
            ->paginate(9);
        return view('website.just-arrived', compact('products'));
    }

}

