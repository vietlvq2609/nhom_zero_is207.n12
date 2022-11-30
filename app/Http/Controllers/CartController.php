<?php

namespace App\Http\Controllers;

use App\Models\Shopping_cart_item;
use App\Models\Product_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop_order;
use App\Models\Order_line;
use Carbon\Carbon;

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
                'product_items.id as product_items_id',
                'products.id as product_id',
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

            // kiểm tra xem trong kho còn hàng không
            $inStock = DB::table('product_items')
            ->where('id', $request->product_item_id)
            ->select('qty_in_stock')
            ->get();

            if($request->qty > $inStock[0]->qty_in_stock )
            {
                return back()->with('message', 'Đã hết hàng!');
            }

            $cart = DB::table('shopping_carts')
                ->where('user_id', auth()->id())
                ->get()
                ->first();

            
            $isExist = Shopping_cart_item::select("*")
                ->where("product_item_id", $request->product_item_id)
                ->where('cart_id', $cart->id)
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

            return redirect('/products')->with('message', 'Cập nhật giỏ hàng!');
        }

        return redirect('/login')->with('message', 'Bạn phải đăng nhập để thêm giỏ hàng!');
    }

    public function prepareView()
    {
        $prepare_bills = DB::table('shop_orders')
        ->where('shop_orders.user_id', auth()->id())
        ->where('shop_orders.order_status', 3)
        ->join('shipping_methods','shipping_methods.id', '=', 'shop_orders.shipping_method')
        ->join('addresses','addresses.id', '=', 'shop_orders.shipping_address')
        ->join('countries','countries.id', '=', 'addresses.country_id')
        ->join('user_payment_methods','user_payment_methods.id', '=', 'shop_orders.payment_method_id')
        ->join('payment_types','payment_types.id', '=', 'user_payment_methods.payment_type_id')
        ->select(
            'shop_orders.id as id',
            'shipping_methods.name as ship_name',
            'shipping_methods.price as ship_price',
            'addresses.unit_number as unit',
            'addresses.street_number as street',
            'addresses.address_line1 as address1',
            'addresses.address_line2 as address2',
            'addresses.city',
            'countries.country_name',
            'payment_types.value',
            'user_payment_methods.provider',
            'user_payment_methods.account_number',
            'order_status as status'
        )
        ->get();

        $prepare_items = DB::table('order_lines')
        ->where('shop_orders.user_id', auth()->id())
        ->where('shop_orders.order_status', 3)
        ->join('shop_orders', 'shop_orders.id', '=', 'order_lines.order_id')
        ->join('product_items', 'product_items.id', '=', 'order_lines.product_item_id')
        ->join('products', 'products.id', '=', 'product_items.product_id')
        ->join('product_configurations', 'product_items.id', '=', 'product_configurations.product_item_id')
        ->join('variation_options', 'variation_options.id', '=', 'product_configurations.variation_option_id')
        ->join('variations', 'variation_options.variation_id', '=', 'variations.id')
        ->select(
            'order_lines.order_id',
            'products.id as product_id',
            'products.name as product_name',
            'products.product_image',
            'order_lines.qty as qty',
            'order_lines.price as price',
            'variations.name as variation_name',
            'variation_options.value as variation_value',
            )
        ->get();

        return view('carts.prepare', [
            'bills' => $prepare_bills,
            'items' => $prepare_items
        ]);
    }

    public function postPrepare(Request $request)
    {
        // kiểm tra xem có địa chỉ mặc định và phương thức mặc định không
        if ($request->shipping_address == 0 || $request->payment_method_id == 0)
        {
            return back()->with('message', 'Phải có địa chỉ mặc định và phương thức mặc định!');
        }

        $shop_order = Shop_order::create([
            'user_id' => auth()->id(),
            'order_date' => Carbon::now(),
            'payment_method_id' => $request->payment_method_id,
            'shipping_address' => $request->shipping_address,
            'shipping_method' => $request->shipping_method,
            'order_total' => $request->order_total,
            'order_status' => 3
        ]);

        $cart = DB::table('shopping_carts')
                ->where('user_id', auth()->id())
                ->get()
                ->first();

        for ($i = 0; $i < $request->order_total ; $i++)
        {
            Order_line::create([
                'product_item_id' => $request->cart_item_id[$i],
                'order_id' => $shop_order->id,
                'qty' => $request->cart_item_qty[$i],
                'price' => $request->cart_item_price[$i],
            ]);
        }

        DB::table('shopping_cart_items')->where('cart_id', '=', $cart->id )->delete();

        return redirect('/cart/prepare')->with('message', 'Đặt hàng thành công!');
    }

    public function shippingView()
    {
        $shipping_bills = DB::table('shop_orders')
        ->where('shop_orders.user_id', auth()->id())
        ->where('shop_orders.order_status', 1)
        ->join('shipping_methods','shipping_methods.id', '=', 'shop_orders.shipping_method')
        ->join('addresses','addresses.id', '=', 'shop_orders.shipping_address')
        ->join('countries','countries.id', '=', 'addresses.country_id')
        ->join('user_payment_methods','user_payment_methods.id', '=', 'shop_orders.payment_method_id')
        ->join('payment_types','payment_types.id', '=', 'user_payment_methods.payment_type_id')
        ->select(
            'shop_orders.id as id',
            'shipping_methods.name as ship_name',
            'shipping_methods.price as ship_price',
            'addresses.unit_number as unit',
            'addresses.street_number as street',
            'addresses.address_line1 as address1',
            'addresses.address_line2 as address2',
            'addresses.city',
            'countries.country_name',
            'payment_types.value',
            'user_payment_methods.provider',
            'user_payment_methods.account_number',
            'order_status as status'
        )
        ->get();

        $shipping_items = DB::table('order_lines')
        ->where('shop_orders.user_id', auth()->id())
        ->where('shop_orders.order_status', 1)
        ->join('shop_orders', 'shop_orders.id', '=', 'order_lines.order_id')
        ->join('product_items', 'product_items.id', '=', 'order_lines.product_item_id')
        ->join('products', 'products.id', '=', 'product_items.product_id')
        ->join('product_configurations', 'product_items.id', '=', 'product_configurations.product_item_id')
        ->join('variation_options', 'variation_options.id', '=', 'product_configurations.variation_option_id')
        ->join('variations', 'variation_options.variation_id', '=', 'variations.id')
        ->select(
            'order_lines.order_id',
            'products.id as product_id',
            'products.name as product_name',
            'products.product_image',
            'order_lines.qty as qty',
            'order_lines.price as price',
            'variations.name as variation_name',
            'variation_options.value as variation_value',
            )
        ->get();

        return view('carts.shipping',[
            'bills' => $shipping_bills,
            'items' => $shipping_items
        ]);
    }

    public function receiveView()
    {
        $receive_bills = DB::table('shop_orders')
        ->where('shop_orders.user_id', auth()->id())
        ->where('shop_orders.order_status', 2)
        ->join('shipping_methods','shipping_methods.id', '=', 'shop_orders.shipping_method')
        ->join('addresses','addresses.id', '=', 'shop_orders.shipping_address')
        ->join('countries','countries.id', '=', 'addresses.country_id')
        ->join('user_payment_methods','user_payment_methods.id', '=', 'shop_orders.payment_method_id')
        ->join('payment_types','payment_types.id', '=', 'user_payment_methods.payment_type_id')
        ->select(
            'shop_orders.id as id',
            'shipping_methods.name as ship_name',
            'shipping_methods.price as ship_price',
            'addresses.unit_number as unit',
            'addresses.street_number as street',
            'addresses.address_line1 as address1',
            'addresses.address_line2 as address2',
            'addresses.city',
            'countries.country_name',
            'payment_types.value',
            'user_payment_methods.provider',
            'user_payment_methods.account_number',
            'order_status as status'
        )
        ->get();

        $receive_items = DB::table('order_lines')
        ->where('shop_orders.user_id', auth()->id())
        ->where('shop_orders.order_status', 2)
        ->join('shop_orders', 'shop_orders.id', '=', 'order_lines.order_id')
        ->join('product_items', 'product_items.id', '=', 'order_lines.product_item_id')
        ->join('products', 'products.id', '=', 'product_items.product_id')
        ->join('product_configurations', 'product_items.id', '=', 'product_configurations.product_item_id')
        ->join('variation_options', 'variation_options.id', '=', 'product_configurations.variation_option_id')
        ->join('variations', 'variation_options.variation_id', '=', 'variations.id')
        ->select(
            'order_lines.order_id',
            'products.id as product_id',
            'products.name as product_name',
            'products.product_image',
            'order_lines.qty as qty',
            'order_lines.price as price',
            'variations.name as variation_name',
            'variation_options.value as variation_value',
            )
        ->get();
        
        return view('carts.receive',[
            'bills' => $receive_bills,
            'items' => $receive_items
        ]);
    }

    public function cancleView()
    {
        $cancle_bills = DB::table('shop_orders')
        ->where('shop_orders.user_id', auth()->id())
        ->where('shop_orders.order_status', 4)
        ->join('shipping_methods','shipping_methods.id', '=', 'shop_orders.shipping_method')
        ->join('addresses','addresses.id', '=', 'shop_orders.shipping_address')
        ->join('countries','countries.id', '=', 'addresses.country_id')
        ->join('user_payment_methods','user_payment_methods.id', '=', 'shop_orders.payment_method_id')
        ->join('payment_types','payment_types.id', '=', 'user_payment_methods.payment_type_id')
        ->select(
            'shop_orders.id as id',
            'shipping_methods.name as ship_name',
            'shipping_methods.price as ship_price',
            'addresses.unit_number as unit',
            'addresses.street_number as street',
            'addresses.address_line1 as address1',
            'addresses.address_line2 as address2',
            'addresses.city',
            'countries.country_name',
            'payment_types.value',
            'user_payment_methods.provider',
            'user_payment_methods.account_number',
            'order_status as status'
        )
        ->get();

        $cancle_items = DB::table('order_lines')
        ->where('shop_orders.user_id', auth()->id())
        ->where('shop_orders.order_status', 4)
        ->join('shop_orders', 'shop_orders.id', '=', 'order_lines.order_id')
        ->join('product_items', 'product_items.id', '=', 'order_lines.product_item_id')
        ->join('products', 'products.id', '=', 'product_items.product_id')
        ->join('product_configurations', 'product_items.id', '=', 'product_configurations.product_item_id')
        ->join('variation_options', 'variation_options.id', '=', 'product_configurations.variation_option_id')
        ->join('variations', 'variation_options.variation_id', '=', 'variations.id')
        ->select(
            'order_lines.order_id',
            'products.id as product_id',
            'products.name as product_name',
            'products.product_image',
            'order_lines.qty as qty',
            'order_lines.price as price',
            'variations.name as variation_name',
            'variation_options.value as variation_value',
            )
        ->get();
        
        return view('carts.cancle',[
            'bills' => $cancle_bills,
            'items' => $cancle_items
        ]);
        return view('carts.cancle');
    }

    public function postCancle(Request $request)
    {
        // đưa đơn hàng vào mục đã hủy
        DB::update(
        'update shop_orders set order_status = 4 where id = ?', [$request->id]
        );

        $order_items = DB::table('order_lines')
        ->where ('order_id', $request->id)
        ->select('product_item_id', 'qty')
        ->get();

        // cập nhật lại số lượng hàng trong kho

        foreach($order_items as $order_item)
        {
            DB::update('
            update product_items
            set qty_in_stock = qty_in_stock + ?
            where id = ?
            ', [$order_item->qty, $order_item->product_item_id]);
        }

        return redirect('/cart/cancle')->with('message', 'Đã hủy đơn hàng!');
    }

    public function buyAgain(Request $request)
    {
        // lấy tất cả các sản phẩm thuộc bill đó
        $order_items = DB::table('order_lines')
        ->where ('order_id', $request->id)
        ->select('product_item_id', 'qty')
        ->get();

        // lấy giỏ hàng
        $cart = DB::table('shopping_carts')
                ->where('user_id', auth()->id())
                ->get()
                ->first();

        // xử lý với từng món hàng trong đơn hàng đã hủy
        foreach($order_items as $order_item)
        {
            // kiểm tra xem trong kho còn hàng không nếu không còn thì bỏ qua lun
            $inStock = DB::table('product_items')
            ->where('id', $order_item->product_item_id)
            ->select('qty_in_stock')
            ->get();

            if( $order_item->qty <= $inStock[0]->qty_in_stock )
            {
                $isExist = Shopping_cart_item::select("*")
                ->where("product_item_id", $order_item->product_item_id)
                ->where('cart_id', $cart->id)
                ->exists();
                    
                if ($isExist)
                {
                    // nếu có rồi thì cập nhật lại giỏ hàng
                    DB::update(
                        'update shopping_cart_items 
                        set qty = qty + ? 
                        where product_item_id = ?', [$order_item->qty, $order_item->product_item_id]);
                }
                else 
                {
                    // nếu không có sẵn trong giỏ hàng thì tạo mới
                    Shopping_cart_item::create([
                        'qty' => $order_item->qty,
                        'product_item_id' => $order_item->product_item_id,
                        'cart_id' => $cart->id
                    ]);
                    DB::update('update product_items set qty_in_stock = qty_in_stock - ? where id = ?', [$order_item->qty , $order_item->product_item_id]);
                }
                
                //giảm số lượng thức ăn(qty_in_stock) có trong product_item
                DB::update('update product_items set qty_in_stock = qty_in_stock - ? where id = ?', [$order_item->qty , $order_item->product_item_id]);
            }
        }

        // xóa đơn hàng trong mục đã hủy này đi
        DB::delete('
        delete from shop_orders where id =?
        ', [$request->id]);

        return redirect('/products')->with('message', 'Thêm vào giỏ hàng thành công');
    }

    public function postReceive(Request $request)
    {
        // đưa đơn hàng vào mục đã mua
        DB::update(
            'update shop_orders set order_status = 5 where id = ?', [$request->id]
        );

        // thêm bình luận cho sản phẩm

        return back()->with('message', 'Đã hủy đơn hàng!');
    }

    public function boughtView()
    {
        $bought_bills = DB::table('shop_orders')
        ->where('shop_orders.user_id', auth()->id())
        ->where('shop_orders.order_status', 5)
        ->join('shipping_methods','shipping_methods.id', '=', 'shop_orders.shipping_method')
        ->join('addresses','addresses.id', '=', 'shop_orders.shipping_address')
        ->join('countries','countries.id', '=', 'addresses.country_id')
        ->join('user_payment_methods','user_payment_methods.id', '=', 'shop_orders.payment_method_id')
        ->join('payment_types','payment_types.id', '=', 'user_payment_methods.payment_type_id')
        ->select(
            'shop_orders.id as id',
            'shipping_methods.name as ship_name',
            'shipping_methods.price as ship_price',
            'addresses.unit_number as unit',
            'addresses.street_number as street',
            'addresses.address_line1 as address1',
            'addresses.address_line2 as address2',
            'addresses.city',
            'countries.country_name',
            'payment_types.value',
            'user_payment_methods.provider',
            'user_payment_methods.account_number',
            'order_status as status'
        )
        ->get();

        $bought_items = DB::table('order_lines')
        ->where('shop_orders.user_id', auth()->id())
        ->where('shop_orders.order_status', 5)
        ->join('shop_orders', 'shop_orders.id', '=', 'order_lines.order_id')
        ->join('product_items', 'product_items.id', '=', 'order_lines.product_item_id')
        ->join('products', 'products.id', '=', 'product_items.product_id')
        ->join('product_configurations', 'product_items.id', '=', 'product_configurations.product_item_id')
        ->join('variation_options', 'variation_options.id', '=', 'product_configurations.variation_option_id')
        ->join('variations', 'variation_options.variation_id', '=', 'variations.id')
        ->select(
            'order_lines.order_id',
            'products.id as product_id',
            'products.name as product_name',
            'products.product_image',
            'order_lines.qty as qty',
            'order_lines.price as price',
            'variations.name as variation_name',
            'variation_options.value as variation_value',
            )
        ->get();
        
        return view('carts.bought',[
            'bills' => $bought_bills,
            'items' => $bought_items
        ]);
    }
}
