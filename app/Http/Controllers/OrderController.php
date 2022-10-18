<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\BaselinkerService;

class OrderController extends Controller
{
    public function show(OrderService $order,Request $request) {
        if($request->id){
            $products = $order->getProductsFromOrder($request->id);
            
            if($products){
                $categories = $order->groupProductsByCategory($products);
            }
            
        }else {
            $products=[];
        }
        // dd($categories);
        return view('orders', ['products'=>$products, 'categories'=>$categories]);
    }
}
