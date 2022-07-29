<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $request = request()->user();
        return new Product([
            "name" => $row['produkt_nazwa'],
            "sku" => $row['produkt_sku'],
            "baseId" => $row['produkt_id'],
            "image" => $row['zdjecie'],
            "user_id"=>$request['id']
        ]);
    }
}
