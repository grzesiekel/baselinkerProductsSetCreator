<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(Request $request)
    {
        $products = $request->user()->products()->latest()->paginate(20);


        return view('admin.products', [
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name' => 'required',
            'sku' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg,gif,svg,xlsx,xls|max:2048'
        ]);


        // dd($file);
        if ($request->hasFile('image')) {

            $filename = $request->user()->name . $request->image->getClientOriginalName();

            $request->image->storeAs('img', $filename, 'public');
        } else {
            $filename = '';
        }

        $sku = strtolower($request->sku);
        $sku = ltrim($sku);
        $sku = rtrim($sku);

        $request->user()->products()->create([
            'name' => $request->name,
            'baseId' =>  $request->baseId,
            'sku' => $sku,
            'image' => $filename,
            'category' =>$request->category
        ]);

        return back();
    }
    public function storeCsv(Request $request)
    {

        Excel::import(new ProductImport, $request->file('csv'));
        return back();
    }

    public function destroy(Product $product)
    {
        // $this->authorize('delete', $post);

        $product->delete();

        return back();
    }
}
