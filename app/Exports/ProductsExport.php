<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductsExport implements FromCollection, WithHeadings, WithMapping
{
    public function __construct($product) {
        $this->product = $product;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->product;
    }

    public function map($product): array {
        return [
            $product->id,
            $product->user->name,
            $product->categories()->implode('name',','),
            $product->title,
            $product->description,
            $product->price,
            $product->created_at,
            $product->updated_at,
            $product->deleted_at,
        ];

    }

    public function headings(): array
    {
        return ["Id", "User Name", "Category", "Title", "Description", "Price", "CreatedAt", "UpdatedAt", "DeletedAt"];
    }
}