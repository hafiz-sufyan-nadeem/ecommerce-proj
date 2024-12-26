<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $products = DB::select("select * from products order by id DESC LIMIT 6");
        $categories = DB::select("select * from categories order by id DESC LIMIT 6");
        $blogs = DB::select("select * from blogs order by id DESC");

        return view('website.index', [
            'products' => $products,
            'categories' => $categories
            ,'blogs' => $blogs
        ]);
    }
}

