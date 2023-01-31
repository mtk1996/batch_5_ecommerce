<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function all()
    {
        $order = Order::where('user_id', auth()->id())
            ->with('product')
            ->paginate(1);
        return response()->json($order);
    }
}
