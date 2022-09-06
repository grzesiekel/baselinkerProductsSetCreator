<?php

namespace App\Http\Controllers;

use App\Services\BaselinkerService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show(BaselinkerService $baselinker) {
        $orders = $baselinker->getOrderById('449176072');
        dd($orders);
    }
}
