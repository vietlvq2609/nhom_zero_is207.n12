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

        $ship_methods = DB::select(
            'select * from shipping_methods'
        );

        $shipping_address_default = DB::select(
            'select addresses.id as id, unit_number as unit, street_number as street, address_line1 as address1,
                address_line2 as address2, city, region, country_name
            from addresses, user_addresses, countries
            where addresses.id = user_addresses.address_id 
                and addresses.country_id = countries.id
                and user_addresses.is_default = true
                and user_addresses.user_id = ?', [auth()->id()]);

        $billing_address_default = DB::select(
            'select user_payment_methods.id as id, value, provider, account_number as number
            from payment_types, user_payment_methods
            where payment_types.id = user_payment_methods.payment_type_id 
                and user_payment_methods.is_default = true
                and user_payment_methods.user_id = ?', [auth()->id()]);

        return view('cart', [
            'categories' => Product_category::get(),
            'items' => $products,
            'ship_methods' => $ship_methods,
            'shipping' =>$shipping_address_default,
            'billing' =>$billing_address_default
        ]);
    }
    // delete cart
    public function destroy(Request $request)
    {
        // kiểm tra xem có trong giỏ hàng ko
        $canDelete = DB::table ('shopping_cart_items')
        ->where('id',$request->id )
        ->select('product_item_id')
        ->get();

        if ($canDelete != null)
        {
            DB::delete('delete from shopping_cart_items where id = ?', [$request->id]);
    
            //tăng số lượng qty_in_stock trong bảng product_item => chưa làm
            DB::update('update product_items set qty_in_stock = qty_in_stock + ? where id = ?', [$request->qty , $canDelete[0]->product_item_id]);
    
            return redirect('/cart')->with('message', 'Đã xóa sản phẩm khỏi giỏ hàng');
        }
        else 
            return back()->with('message', 'Sản phẩm không tồn tại trong giỏ hàng');
    }

    // add new cart
    public function store(Request $request)
    {
        if (Auth::user() ?? null) {
            $cart = DB::table('shopping_carts')
                ->where('user_id', auth()->id())
                ->get()
                ->first();

            
            $isExist = Shopping_cart_item::select("*")
                ->where("product_item_id", $request->product_item_id)
                ->exists();
            
            if ($isExist)
            {
                // nếu có rồi thì cập nhật lại giỏ hàng
                DB::update(
                    'update shopping_cart_items 
                    set qty = qty + ? 
                    where product_item_id = ?', [$request->qty, $request->product_item_id]);
            }
            else 
            {
                // nếu không có sẵn trong giỏ hàng thì tạo mới
                Shopping_cart_item::create([
                    'qty' => $request->qty,
                    'product_item_id' => $request->product_item_id,
                    'cart_id' => $cart->id
                ]);
                DB::update('update product_items set qty_in_stock = qty_in_stock - ? where id = ?', [$request->qty , $request->product_item_id]);
                return redirect('/products')->with('message', 'Thêm vào giỏ hàng thành công');
            }

            //giảm số lượng thức ăn(qty_in_stock) có trong product_item
            DB::update('update product_items set qty_in_stock = qty_in_stock - ? where id = ?', [$request->qty , $request->product_item_id]);

            return redirect('/products')->with('message', 'Cập nhật giỏ hàng');
        }

        return redirect('/login')->with('message', 'Bạn phải đăng nhập để thêm giỏ hàng!');
    }
}
