<?php 

namespace App\Services;

use App\Models\Set;

class OrderService {

    private $sets;
    private $baselinker;
    public function __construct(Set $sets,BaselinkerService $baselinker)
    {
        $this->sets = $sets;
        $this->baselinker = $baselinker;
    }

    public function getProductsFromSets(){
       $products = [];

       $baselinkerProducts =$this->baselinker->getOrderById('449918248')->products;

       foreach ($baselinkerProducts as $baselinkerProduct){
        
        $baselinkerProductSku = strtolower($baselinkerProduct->sku);
        $baselinkerProductSku = ltrim($baselinkerProductSku);
        $baselinkerProductSku = rtrim($baselinkerProductSku);
        $baselinkerProductQuantity = $baselinkerProduct->quantity;
        $sets = $this->sets->where('sku',$baselinkerProductSku)->first();
        if($sets){
            $productsFromSet=$sets->products;
            
            foreach ($productsFromSet as $productFromSet){
                $products[] = ['name'=>$productFromSet->name,'sku'=>$productFromSet->sku];
            }
        }else{
            $products[]=$baselinkerProduct;
        }
       }
        dd($products);
    }
    
}