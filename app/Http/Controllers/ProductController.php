<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\category_product;
use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function add() {
        $categories = Category::all();
        return view('/products/create', [
            'categories' => $categories
        ]);
    }

    public function create() {
        $validator = validator(request()->all(), [
            'title' => 'required|max:200',
            'description' => 'required|max:700',
            'price' => 'required',
        ]);
        if($validator->fails()) {

            return back()->withErrors($validator);
        }
        
        $product = new Product;
        $product ->user_id = request()->user_id;
        $product->title = request()->title;
        $product->description = request()->description;
        $product->price = request()->price;
        $product->save();

        $last_id = $product -> id;
        
        for ($i = 0; $i < count(request()->cat); $i++) {
            $category_product = new category_product;
        $category_product -> product_id = $last_id;
        $category_product -> category_id =  request()->cat[$i];
        $category_product -> save();
        }

        return redirect('/products/list');
    }

    public function list() {
        $product = Product::all();
        return view('products.list', [
            'products' => $product
        ]);
    }

    public function edit($id) {
        $categories = Category::all();
        $product = Product::find($id);
        return view('products.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update($id) {
        $validator = validator(request()->all(), [
            'title' => 'required|max:200',
            'description' => 'required|max:700',
            'price' => 'required',
        ]);
        if($validator->fails()) {
            
            return back()->withErrors($validator);
        }
        $product = Product::find($id);
        $product -> title = request()->title;
        $product -> description = request() -> description;
        $product -> price = request() -> price;
        $product -> save();

        return redirect('/products/list');
    }

    public function delete($id) {
        $dt = new DateTime();
        $product = Product::find($id);
        $product->deleted_at = $dt;
        $product -> save();

        return redirect('/products/list');
    }
}