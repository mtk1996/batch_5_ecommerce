<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product_slug =  $request->product_slug;
        $findProduct = Product::where('slug', $product_slug)->first();
        if (!auth()->check()) {
            return 'not_auth';
        }
        if (!$findProduct) {
            return 'product_not_found';
        }

        $user_id = auth()->id();

        Cart::create([
            'product_id' => $findProduct->id,
            'user_id' => $user_id,
            'stock_qty' => 1,
        ]);

        $cart_qty = Cart::where('user_id', $user_id)->count();


        return response()->json([
            'cart_qty' => $cart_qty,
        ]);
    }
}
