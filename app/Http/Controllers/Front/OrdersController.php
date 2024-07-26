<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function show($order)
    {
        $delivery = DB::table('deliveries')->where('order_id', $order)->first();
        // dd($delivery);

        return view('front.orders.show', compact('order', 'delivery'));
    }
}
