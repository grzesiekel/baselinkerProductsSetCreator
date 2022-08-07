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
}
