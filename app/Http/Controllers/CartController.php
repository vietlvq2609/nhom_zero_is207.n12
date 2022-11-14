<?php

namespace App\Http\Controllers;

use App\Models\Shopping_cart_item;
use App\Models\Product_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // show card page
    public function index()
    {
        $products = DB::table('shopping_carts')
            ->where('shopping_carts.user_id', auth()->id())
            ->join('shopping_cart_items', 'shopping_cart_items.cart_id', '=', 'shopping_carts.id')
            ->join('product_items', 'product_items.id', '=', 'shopping_cart_items.product_item_id')
            ->join('products', 'products.id', 'product_items.product_id')
            ->join('product_configurations', 'product_items.id', '=', 'product_configurations.product_item_id')
            ->join('variation_options', 'variation_options.id', '=', 'product_configurations.variation_option_id')
            ->join('variations', 'variation_options.variation_id', '=', 'variations.id')
            ->select(
                'shopping_cart_items.qty',
                'shopping_cart_items.id',
                'products.product_image',
                'products.name as product_name',
                'product_items.price',
                'variations.name as variation_name',
                'variation_options.value as variation_value',

            )
            ->get();

        return view('cart', [
            'categories' => Product_category::get(),
            'items' => $products
        ]);
    }
    // delete cart
    public function destroy($id)
    {
        Shopping_cart_item::find($id)->delete();
        return redirect('/cart')->with('message', 'Đã xóa sản phẩm khỏi giỏ hàng');
    }

    // add new cart
    public function store(Request $request)
    {
        if (Auth::user() ?? null) {
            $cart = DB::table('shopping_carts')
                ->where('user_id', auth()->id())
                ->get()
                ->first();

            Shopping_cart_item::create([
                'qty' => $request->qty,
                'product_item_id' => $request->product_item_id,
                'cart_id' => $cart->id
            ]);

            return redirect('/products')->with('message', 'Thêm vào giỏ hàng thành công');
        }

        return redirect('/login')->with('message', 'Bạn phải đăng nhập để thêm giỏ hàng!');
    }
}
