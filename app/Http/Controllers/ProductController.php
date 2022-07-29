<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(Request $request) {
        // $products = $request->user()->products()->latest()->paginate(20);
        $products = "";
        
        return view('admin.products',[
            'products'=>$products
        ]);
    }
}
