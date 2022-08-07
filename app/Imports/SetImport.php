<?php

namespace App\Imports;

use App\Models\Set;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SetImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $request = request()->user();
        return new Set([
            "name" => $row['produkt_nazwa'],
            "sku" => $row['produkt_sku'],
            "baseId" => $row['produkt_id'],
            "image" => $row['zdjecie'],
            "user_id"=>$request['id']
        ]);
    }
}
