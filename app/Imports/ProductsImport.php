<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
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
            //$profile= User::where('name',$row['user'])->get();

            $product = new Product();
            $product->user_id = $row['user_id'];
            $product->title = $row['title'];
            $product->description = $row['description'];
            $product->price = $row['price'];
            $product->save();

           $categories = explode(',',$row['category_name']);

           foreach($categories as $value){
                $category = Category::where('name',$value)->get();
                $category_id = $category->pluck('id');
                $product->categories()->attach($category_id);
            }

            }
        }
}
