<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['products'] = DB::table('products')
                                    ->join('categories', 'categories.id', '=', 'products.category_id')
                                    ->select('categories.c_name', 'products.*')
                                    ->get();
        $data['categories'] = Category::all();
        
        return view('home', $data);
    }
}
