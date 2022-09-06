<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class BaselinkerService {
    private $token;
    public function __construct(){
        $this->token = '2104-16553-U04FAJEUAHCJ59QOYZPPVJZX73IOCXMFV0CU6K7HS0QHOHIWII6GXKSL4A2HBYRE';
    }
    public function getOrderById($orderId) {
        $parameters = ['order_id' => $orderId];;
        $response = Http::asForm()->post('https://api.baselinker.com/connector.php',[
            'token' => $this->token,
            'method' => 'getOrders',
            'parameters' => json_encode($parameters, JSON_UNESCAPED_UNICODE),
            
        ]);
        return json_decode($response)->orders[0] ;
    }
}