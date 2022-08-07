<?php

namespace App\Models;

use App\Models\Set;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'baseId',
        'sku',
        'image',
        'user_id'
    ];

    public function sets() {
        return $this->belongsToMany(Set::class)->withPivot("quantity");
    }
}
