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

    public function store(Request $request) {
        // dd($request);
        $this->validate($request, [
            'name' => 'required',
            'sku' => 'required',
            'baseId'=>'unique:collections,baseId',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg,xlsx,xls|max:2048'
        ]);
        
        $file= $request->file('image');
        // dd($file);
        if($file !== null) {
            $filename= date('YmdHi').$file->getClientOriginalName();
        $file->move(public_path('sb-admin/img'), $filename);
        $pathToImage = asset('sb-admin/img') .'/'. $filename;
        }else{
            $pathToImage = '';
        }
        
        $sku = strtolower($request->sku);
        $sku = ltrim($sku);
        $sku = rtrim($sku);
        
        $request->user()->products()->create([
            'name' =>$request->name,
            'baseId' =>  $request->baseId,
            'sku' => $sku,
            'image' => $pathToImage
        ]);

        return back();
         
    }
  
}