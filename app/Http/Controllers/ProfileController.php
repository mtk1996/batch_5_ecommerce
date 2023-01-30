<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function showProfile()
    {
        return view('user.profile');
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
}
