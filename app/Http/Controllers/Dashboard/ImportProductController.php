<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\ImportProducts;
use Illuminate\Http\Request;

class ImportProductController extends Controller
{
    public function create(){
        return view('dashboard.import-product.create');
    }
    public function store(request $request){
       ImportProducts::dispatch($request->product_count)->onQueue('import');
       return redirect()->route('products.index')->with('success', 'Start Importing products ....');
    }

}
