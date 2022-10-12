<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function add() {
        return view('/products/create');
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
        return redirect('/');
    }
}
