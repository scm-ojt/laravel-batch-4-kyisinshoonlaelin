<?php

namespace App\Imports;

use App\Models\User;
use App\Models\Product;

use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, WithHeadingRow
{
    /**
     * Undocumented function
     *
     * @param Collection $rows
     * @return void
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row)
        {
            if($row['deletedat'] != null) {
                $product= Product::find($row['id']);
                $product->delete();
            } else {
            $user = User::where('name', $row['username'])->get()->first();
            $product = Product::find($row['id']);
            if($product != null) {
                    $product->user_id = $user->id;
                    $product->title = $row['title'];
                    $product->description = $row['description'];
                    $product->price = $row['price'];
                    $product->save();

                    $categories = explode(',',$row['category']);

                    foreach($categories as $value){
                        $category = Category::where('name',$value)->get();
                        $category_id = $category->pluck('id');
                        $product->categories()->attach($category_id);
                    }

            }
            else {
            $product = new Product();
            $product->user_id = $user->id;
            $product->title = $row['title'];
            $product->description = $row['description'];
            $product->price = $row['price'];
            $product->save();

            $categories = explode(',',$row['category']);

            foreach($categories as $value){
                $category = Category::where('name',$value)->get();
                $category_id = $category->pluck('id');
                $product->categories()->attach($category_id);
            }
        }
    }

        }
    }
}
