<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Models\CategoryProduct;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('/products/create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        $validated = $request->validated();

        $product = new Product;
        $product ->user_id = auth()->user()->id;
        $product->title = request()->title;
        $product->description = request()->description;
        $product->price = request()->price;
        $product->save();

        $last_id = $product -> id;
        
        for ($i = 0; $i < count(request()->categories); $i++) {
            $category_product = new CategoryProduct;
            $category_product -> product_id = $last_id;
            $category_product -> category_id =  request()->categories[$i];
            $category_product -> save();
        }

        $image = new Image;      
        $imageName = time().'.'.$request->image->extension();     
        $request->image->move(public_path('images'), $imageName);
        $image -> name = $imageName;
        $image -> path = 'images/'.$imageName;
        $image -> imageable_id = $product->id;
        $image -> imageable_type = get_class($product);
        $image -> save();

        return redirect()->route('products.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('products.show', compact('product'));
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function index() {
        $products = Product::latest()->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function getProducts() {
        $products = Product::all();

        return view('products.user.index', compact('products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        
        if( Gate::allows('product-edit', $product) ) {
            
            return view('products.edit', [
                'product' => $product,
                'categories' => $categories
            ]);
        } else {
            return back()->with('error', 'Unauthorize');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
        $product = Product::find($id);
        $product -> title = request()->title;
        $product -> description = request() -> description;
        $product -> price = request() -> price;
        $product -> save();

        $category_product = CategoryProduct::where('product_id',$id)->delete();
        if(isset($request->image)) {
            $image_path = public_path('images').'/'.$product->image->name;
            unlink($image_path);
            $image = Image::where('imageable_id',$id)->delete();

            $image = new Image;
            $image -> imageable_id = $id;
            $image -> imageable_type = get_class($product);
            $imageName = time().'.'.$request->image->extension();     
            $request->image->move(public_path('images'), $imageName);
            $image -> name = $imageName;
            $image -> path = 'images/'.$imageName;
            $image -> save();
        } 
        $categories = request()->categories;
        foreach($categories as $category) {
            $category_product = new CategoryProduct;
            $category_product -> product_id = $id;
            $category_product -> category_id = $category;
            $category_product -> save();
        }

        return redirect()->route('products.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if( Gate::allows('product-delete', $product) ) {            
            $image_path = public_path('images').'/'.$product->image->name;
            unlink($image_path);
            $product-> delete();
            $image = Image::where('imageable_id',$id)->delete();

            return redirect()->route('products.user.index');
        } else {
            return back()->with('error', 'Unauthorize');
        }
        
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function export() 
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function import() 
    {
        Excel::import(new ProductsImport,request()->file('file'));
               
        return back();
    }

}