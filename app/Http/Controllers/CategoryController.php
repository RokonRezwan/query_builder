<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function index()
    {
        $data['categories'] = Category::all();

        return view('categories.index', $data);
    }

    public function status(Category $category)
    {
        
        if ($category->is_active == 1) 
         {
            $users = DB::table('categories')->where('id', '=',$category->id)->update([
                'is_active' => 0,
            ]);            
         }
        else 
         {
            $users = DB::table('categories')->where('id', '=',$category->id)->update([
                'is_active' => 1,
            ]);
         }

         return redirect()->back()->with('success','Product Status changed successfully');
    }
}
