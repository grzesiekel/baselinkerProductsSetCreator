<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Set extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'baseId',
        'sku',
        'image',
        'user_id'
    ];
    public function products() {
        return $this->belongsToMany(Product::class)->withPivot("quantity");
    }
}
