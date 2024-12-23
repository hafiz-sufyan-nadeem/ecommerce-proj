<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $product = DB::select( DB::raw("SELECT * FROM products order by  = '$someVariable'") );

    }
}
