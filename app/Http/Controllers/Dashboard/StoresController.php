<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    //
    public function index()
    {
        $stores = Store::all();
        return view('dashboard.stores.index', compact('stores'));
    }

    public function create()
    {
        return view('dashboard.stores.create');
    }
    public function show()
    {
        return view('dashboard.stores.show');
    }
    public function edit()
    {
        return view('dashboard.stores.edit');
    }
    public function update()
    {
        return view('dashboard.stores.update');
    }
    public function destroy()
    {
        return view('dashboard.stores.destroy');
    }
    public function restore()
    {
        return view('dashboard.stores.restore');
    }
    public function forceDelete()
    {
        return view('dashboard.stores.forceDelete');
    }
    public function trash()
    {
        return view('dashboard.stores.trash');
    }
}
