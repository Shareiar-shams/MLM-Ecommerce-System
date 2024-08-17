<?php
namespace App\Imports;

use App\Models\Admin\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ProductsImport implements ToModel, WithStartRow, WithCustomCsvSettings
{
    public function startRow(): int
    {
        return 2;
    }

    public function getCsvSettings(): array
    {
        return [
            
        ];
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'name' => $row[0], // Adjust column indexes as needed
            'slug' => $row[1],
            'SKU' => $row[2],
            'affiliate_link' => $row[3],
            'featured_image' => $row[4],
            'gallery_image' => $row[5],
            'short_description' => $row[6],
            'description' => $row[7],
            'productType' => $row[8],
            'tags' => $row[9],
            'specifications' => $row[10],
            'specification_name' => $row[11],
            'specification_description' => $row[12],
            'stock' => $row[13],
            'type_id' => $row[14],
            'category_id' => $row[15],
            'subcategory_id' => $row[16],
            'price' => $row[17],
            'special_price' => $row[18],
            'video_link' => $row[19],
            'meta_keywords' => $row[20],
            'meta_descriptions' => $row[21],
            'status' => $row[22]
            // Add other fields here
        ]);
    }
}
