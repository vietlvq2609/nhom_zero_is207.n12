<?php

namespace App\Http\Controllers;

use App\Models\Shopping_cart_item;
use App\Models\Product_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // show card page
    public function index()
    {
        return view('cart', ['categories' => Product_category::get()]);
    }

    // add new cart
    public function store(Request $request)
    {
        dd($request);
        $cart = DB::table('shopping_carts')
            ->where('user_id', auth()->id())
            ->get()->first();

        Shopping_cart_item::create([
            'qty' => $request->qty,
            'product_item_id' => $request->product_item_id,
            'cart_id' => $cart->id
        ]);

        return redirect('/');
    }
}
