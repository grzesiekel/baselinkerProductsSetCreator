<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        Excel::import(new ProductImport, $request->file('csv'));
        return back();
    }
}
