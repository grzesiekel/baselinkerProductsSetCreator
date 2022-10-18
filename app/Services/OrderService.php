<?php 

namespace App\Services;

use App\Models\Set;
use PhpParser\Node\Expr\Cast\Array_;

class OrderService {

    private $sets;
    private $baselinker;
    public function __construct(Set $sets,BaselinkerService $baselinker)
    {
        $this->sets = $sets;
        $this->baselinker = $baselinker;
    }

    public function getProductsFromOrder($id){
       $products = [];
       if(!$this->baselinker->getOrderById($id)){
        return [];
       }
       $baselinkerProducts =$this->baselinker->getOrderById($id)[0]->products;

       foreach ($baselinkerProducts as $baselinkerProduct){
        
        $baselinkerProductSku = strtolower($baselinkerProduct->sku);
        $baselinkerProductSku = ltrim($baselinkerProductSku);
        $baselinkerProductSku = rtrim($baselinkerProductSku);
        $baselinkerProductQuantity = $baselinkerProduct->quantity;
        $sets = $this->sets->where('sku',$baselinkerProductSku)->first();
        if($sets){
            $productsFromSet=$sets->products;
            
            foreach ($productsFromSet as $productFromSet){
                $products[] = ['name'=>$productFromSet->name,'sku'=>$productFromSet->sku,
                'quantity'=>$productFromSet->pivot->quantity*$baselinkerProduct->quantity,
                'image'=>$productFromSet->image,
                'category'=>$productFromSet->category];
            }
        }else{
            $products[]=['name'=>$baselinkerProduct->name,'sku'=>$baselinkerProduct->sku,
            'quantity'=>$baselinkerProduct->quantity,
            'image'=>'',
                'category'=>'inna'];
        }
       }
       $products = $this->groupProductsBySku($products);
       return $products;
        
    }

    public function groupProductsBySku(Array $array) {
        $result = array_reduce($array, function($carry, $item){ 
            if(!isset($carry[$item['sku']])){ 
                $carry[$item['sku']] = ['sku'=>$item['sku'],'name'=>$item['name'],'quantity'=>$item['quantity'],
                'image'=>$item['image'],'category'=>$item['category']]; 
            } else { 
                $carry[$item['sku']]['quantity'] += $item['quantity']; 
            } 
            return $carry; 
        });
        $productsArr = [];
        foreach ($result as $item) {
            $productsArr[] = $item;
        }
        return $productsArr;
    }

    public function groupProductsByCategory(Array $array) {
        $result = [];
        foreach ($array as $product) {
            if (array_key_exists($product['category'],$result)){
                $result[$product['category']][] = $product;
            }else {
                $result[$product['category']][] = $product;
            }
        }
        return $result;
    }
    
}