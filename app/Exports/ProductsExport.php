<?php

namespace App\Exports;

use App\Models\Admin\Product;
use Maatwebsite\Excel\Concerns\FromCollection;


class ProductsExport implements FromCollection
{
    public function collection()
    {
        return Product::all(); // You can customize this query as needed
    }
}
