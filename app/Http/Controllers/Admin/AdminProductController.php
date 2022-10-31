<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Models\CategoryProduct;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CsvImportRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductUpdateRequest;

class AdminProductController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductCreateRequest $request)
    {
        $product = new Product;
        $product ->user_id = auth()->id();
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('admins.products.edit', [
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

        return redirect()->route('admins.products.index');
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
        if($product->image?->path != null) {
            $image_path = public_path('images').'/'.$product->image->name;
            unlink($image_path);
            $image = Image::where('imageable_id',$id)->delete();
        }
        $product-> delete();
        
        return redirect()->route('admins.products.index');
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
        return view('admins.products.search', compact('searchedProducts'));
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function index(Request $request) 
    {
        if($request->isMethod('get')) {
            if($request->has('searchSubmit')) {
                if(!isset($request->search)) {
                    return redirect()->route('admins.products.index');
                }
                    $products = Product::where('title','LIKE','%'.$request->search.'%')->paginate(7);
            }
            else if($request->has('export')) {
                if(isset($request->search)) {
                    $exportProducts = Product::where('title','LIKE','%'.$request->search.'%')->get();
                }
                else {
                    $exportProducts = Product::all();
                }

                return Excel::download(new ProductsExport($exportProducts), 'products.csv');
            }
            else{
                $products = Product::orderBy('id', 'desc')->paginate(7);
            }

            return view('admins.products.index', [
                'products' => $products,
                'search' => $request->search,
            ]);
        }
       
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function import(CsvImportRequest $request) 
    {
        $path = $request->file('csvFile');
        Excel::import(new ProductsImport, $path);
        Session::flash('success', 'Leave Records Imported Successfully');

        return back();
    }

}