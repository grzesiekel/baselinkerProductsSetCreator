<?php

namespace App\Http\Controllers;

use App\Models\Set;
use App\Models\Product;
use App\Imports\SetImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SetController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index(Request $request) {
        $sets = $request->user()->sets()->latest()->paginate(20);
        
        
        return view('admin.sets',[
            'sets'=>$sets
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

        $request->user()->sets()->create([
            'name' => $request->name,
            'baseId' =>  $request->baseId,
            'sku' => $sku,
            'image' => $filename,
        ]);

        return back();
    }

    public function storeCsv(Request $request)
    {

        Excel::import(new SetImport, $request->file('csv'));
        return back();
    }

    public function destroy(Set $set)
    {
        // $this->authorize('delete', $post);

        $set->delete();

        return back();
    }
    public function show(Request $request,Set $set)
    {
        $setProducts = $set->products;
        
        $name = '%' . $request->productsName . '%';
        $products = $request->user()->products()->where('name','like',$name)->get();
        // dd($products);
        return view('admin.set', [
            'products' => $products,
            'set' =>$set,
            'setProducts'=>$setProducts
        ]);
    }
    public function attachProduct(Request $request,Set $set, Product $product) {
        $this->validate($request, [
            'quantity' => 'required'
        ]);
        $set->products()->attach($product,['quantity'=>$request->quantity]);
        return back();
    }
    public function detachProduct(Set $set, Product $product){
        $set->products()->detach($product);
        return back();
    }
}
