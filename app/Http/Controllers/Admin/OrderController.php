<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {

        $order = Order::with('product', 'user');
        if ($status = request()->status) {
            $order->where('status', $status);
        }
        $order = $order->paginate(10);
        return view('admin.order.index', compact('order'));
    }

    public function changeStatus()
    {
        $status = request()->status;
        $order_id = request()->id;

        Order::where('id', $order_id)->update([
            'status' => $status,
        ]);
        return redirect()->back()->with('success', 'Order Status Changed');
    }
}
