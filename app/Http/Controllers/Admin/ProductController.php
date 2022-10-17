<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\CategoryProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

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
        $product ->user_id = request()->user_id;
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

        return redirect()->route('products.index');
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

        return view('products.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
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
        $validated = $request->validated();

        $product = Product::find($id);
        $product -> title = request()->title;
        $product -> description = request() -> description;
        $product -> price = request() -> price;
        $product -> save();

        $category_product = CategoryProduct::where('product_id',$id)->delete();
        //$category_product -> delete();

        $categories = request()->categories;
        foreach($categories as $category) {
            $category_product = new CategoryProduct;
            $category_product -> product_id = $id;
            $category_product -> category_id = $category;
            $category_product -> save();
        }

        return redirect()->route('products.index');
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
        $product-> delete();

        return redirect()->route('products.index');
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request){
        // Get the search value from the request
        $search = $request->input('search');
    
        // Search in the title and body columns from the posts table
        //filter nk yayy yan
        $searchedProducts = Product::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('price', 'LIKE', "%{$search}%")
            ->get();
    
        // Return the search view with the resluts compacted
        return view('products.search', compact('searchedProducts'));
    }

    public function showDashboard() {
        $userName = auth()->user()->name;
        return view('adminLte.dashboard', compact('userName'));
    }

}