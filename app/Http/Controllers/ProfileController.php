<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showProfile()
    {
        $total = 10000;
        return view('user.profile', compact('total'));
    }

    public function cart()
    {
        $cart = Cart::where('user_id', auth()->id())
            ->with('product')
            ->get();
        return  response()->json($cart);
    }

    public function removeCart(Request $request)
    {
        $id = $request->id;
        Cart::where('id', $id)->delete();
        return 'success';
    }

    public function addCartQty(Request $request)
    {
        $id = $request->id;
        Cart::where('id', $id)->update([
            'stock_qty' => DB::raw('stock_qty+1'),
        ]);
        return 'success';
    }

    public function changePassword(Request $request)
    {
        //check valid password
        $current = $request->current;
        $new = $request->new;

        $user = User::where('id', auth()->id())->first();

        $checkPassword =    Hash::check($current, $user->password);
        if (!$checkPassword) {
            return 'wrong_current';
        }

        User::where('id', auth()->id())->update([
            'password' => Hash::make($new),
        ]);
        return 'success';
    }


    public function makeOrder(Request $request)
    {
        $file =  $request->file('image');
        $file_name = uniqid() . $file->getClientOriginalName();
        $file->move(public_path('/images'), $file_name);

        $dbCarts = Cart::where('user_id', auth()->id())->get();
        foreach ($dbCarts as $sCart) {
            Order::create([
                'user_id' => auth()->id(),
                'product_id' => $sCart->product_id,
                'stock_qty' => $sCart->stock_qty,
                'payment_screenshot' => $file_name,
                'shipping_address' => $request->address,
                'phone' => $request->phone,
            ]);
        }

        Cart::where('user_id', auth()->id())->delete();

        return 'success';
    }
}
