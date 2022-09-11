<?php 

namespace App\Services;

use App\Models\Set;

class OrderService {

    private $sets;
    public function __construct(Set $sets)
    {
        $this->sets = $sets;
    }

    public function getProductsFromSets(){
        dd($this->sets);
    }
    
}