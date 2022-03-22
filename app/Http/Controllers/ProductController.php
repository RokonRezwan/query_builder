<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index()
    {
        $data['products'] = DB::table('products')
                                ->join('categories', 'categories.id', '=', 'products.category_id')
                                ->select('categories.c_name', 'products.*')
                                ->get();

        return view('products.index', $data);
    }

    public function create()
    {
        $data['categories'] = DB::table('categories')
                                  ->where('is_active', '=', 1)
                                  ->get();

        return view('products.create', $data);
    }

    public function store(Request $request)
    {
        //validate the input
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'is_active' => 'required|boolean',
        ]);

        //creat a new product
        DB::table('products')->insert([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'is_active' => $request->is_active,
        ]);

        //redirect the user and send friendly message
        return redirect()->route('products.index')->with('success','Product created successfully');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = DB::table('categories')
                            ->where('is_active', '=', 1)
                            ->get();

        return view('products.edit', compact(['product','categories']));
    }

    public function update(Request $request, Product $product)
    {
        //validate the input
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',            
            'is_active' => 'required|boolean',
        ]);

        //update product
        $users = DB::table('products')
                        ->where('id', '=',$product->id)
                        ->update([
                            'name' => $request->name,
                            'category_id' => $request->category_id,
                            'is_active' => $request->is_active,
                        ]);

        //redirect the user and send friendly message
        return redirect()->route('products.index')->with('success','Product updated successfully');
    }

    public function destroy(Product $product)
    {
        //delete the product
        $deleted = DB::table('products')->where('id', '=',$product->id)->delete();

        //redirect the user with a success message
        return redirect()->route('products.index')->with('success','Product deleted successfully');
    }

    public function status(Product $product)
    {
        if ($product->is_active == 1) 
         {
            $users = DB::table('products')
                            ->where('id', '=',$product->id)
                            ->update([
                                'is_active' => 0,
                            ]);            
         }
        else 
         {
            $users = DB::table('products')
                            ->where('id', '=',$product->id)
                            ->update([
                                'is_active' => 1,
                            ]);
         }

         return redirect()->back()->with('success','Product Status changed successfully');
    }
}
