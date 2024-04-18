<?php

// app/Imports/ProductsImport.php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;

class ProductsImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Product::create([
                'category_id' => $row[0],
                'name' => $row[1],
                'slug' => $row[2],
                'brand' => $row[3],
                'small_description' => $row[4],
                'description' => $row[5],
                'original_price' => $row[6],
                'selling_price' => $row[7],
                'quantity' => $row[8],
                'trending' => $row[9],
                'featured' => $row[10],
                'status' => $row[11],
                'meta_title' => $row[12],
                'meta_keyword' => $row[13],
                'meta_description' => $row[14],
            ]);
        }
    }
}
