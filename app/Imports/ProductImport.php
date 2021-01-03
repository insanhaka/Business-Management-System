<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Product;

class ProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // dd($row['name']);
        return new Product([
            'id' => $row['id'],
            'name' => $row['nama_produk'],
            'description' => $row['deskripsi'],
            'stock' => $row['stok'],
            'price' => $row['harga'],
            'is_active' => $row['is_active'],
            'product_categories_id' => $row['id_kategori_produk'],
            'business_id' => $row['id_usaha'],
        ]);
    }
}
