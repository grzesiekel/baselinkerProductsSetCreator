<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Services\BaselinkerService;

class OrderController extends Controller
{
    public function show(OrderService $order) {
        $products = $order->getProductsFromSets();
        dd($products);
    }
}
