<?php

namespace App\Http\Controllers;

use App\Models\Shopping_cart_item;
use App\Models\Product_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop_order;
use App\Models\Order_line;
use App\Models\User_review;
use Carbon\Carbon;
use App\Models\User;
use App\Models\User_payment_method;
use App\Models\Payment_type;
use App\Models\Shipping_method;
use App\Models\Address;
use Illuminate\Support\Facades\Mail;

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
        // ki???m tra xem c?? trong gi??? h??ng ko
        $canDelete = DB::table ('shopping_cart_items')
        ->where('id',$request->id )
        ->select('product_item_id')
        ->get();

        if ($canDelete != null)
        {
            DB::delete('delete from shopping_cart_items where id = ?', [$request->id]);
    
            //t??ng s??? l?????ng qty_in_stock trong b???ng product_item => ch??a l??m
            DB::update('update product_items set qty_in_stock = qty_in_stock + ? where id = ?', [$request->qty , $canDelete[0]->product_item_id]);
    
            return redirect('/cart')->with('message', '???? x??a s???n ph???m kh???i gi??? h??ng');
        }
        else 
            return back()->with('message', 'S???n ph???m kh??ng t???n t???i trong gi??? h??ng');
    }

    // add new cart
    public function store(Request $request)
    {
        if (Auth::user() ?? null) {

            // ki???m tra xem trong kho c??n h??ng kh??ng
            $inStock = DB::table('product_items')
            ->where('id', $request->product_item_id)
            ->select('qty_in_stock')
            ->get();

            if($request->qty > $inStock[0]->qty_in_stock )
            {
                return back()->with('message', '???? h???t h??ng!');
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
                // n???u c?? r???i th?? c???p nh???t l???i gi??? h??ng
                DB::update(
                    'update shopping_cart_items 
                    set qty = qty + ? 
                    where product_item_id = ?', [$request->qty, $request->product_item_id]);
            }
            else 
            {
                // n???u kh??ng c?? s???n trong gi??? h??ng th?? t???o m???i
                Shopping_cart_item::create([
                    'qty' => $request->qty,
                    'product_item_id' => $request->product_item_id,
                    'cart_id' => $cart->id
                ]);
                DB::update('update product_items set qty_in_stock = qty_in_stock - ? where id = ?', [$request->qty , $request->product_item_id]);
                return redirect('/products')->with('message', 'Th??m v??o gi??? h??ng th??nh c??ng');
            }

            //gi???m s??? l?????ng th???c ??n(qty_in_stock) c?? trong product_item
            DB::update('update product_items set qty_in_stock = qty_in_stock - ? where id = ?', [$request->qty , $request->product_item_id]);

            return redirect('/products')->with('message', 'C???p nh???t gi??? h??ng!');
        }

        return redirect('/login')->with('message', 'Ba??n pha??i ????ng nh????p ?????? th??m gio?? ha??ng!');
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
        // ki???m tra xem c?? ?????a ch??? m???c ?????nh v?? ph????ng th???c m???c ?????nh kh??ng
        if ($request->shipping_address == 0 || $request->payment_method_id == 0)
        {
            return back()->with('message', 'Ph???i c?? ?????a ch??? m???c ?????nh v?? ph????ng th???c m???c ?????nh!');
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

        for ($i = 0; $i < $request->total_items ; $i++)
        {
            Order_line::create([
                'product_item_id' => $request->cart_item_id[$i],
                'order_id' => $shop_order->id,
                'qty' => $request->cart_item_qty[$i],
                'price' => $request->cart_item_price[$i],
            ]);
        }
        // G???i mail x??c nh???n cho kh??ch, b???o kh??ch chuy???n kho???ng
        // n???u kh??ch ch???n ph????ng th???c thanh to??n l?? "tr??? b???ng ti???n m???t th?? kh??ng c???n g???i mail
        $payment= User_payment_method::where('user_payment_methods.id',$request->payment_method_id)
        ->join('payment_types','payment_types.id','=','payment_type_id')
        ->select('payment_types.id')
        ->first();
        if($payment->id != 1 )
        {
            $user = User::where('id', auth()->id())->first();
            $payment_method = User_payment_method::where('user_payment_methods.id',$request->payment_method_id)
                ->join('payment_types','payment_types.id', '=', 'user_payment_methods.payment_type_id')
                ->select('value')
                ->first();
            $shipping_method = Shipping_method::where('id',$request->shipping_method)->first();
            $shipping_address = DB::table('addresses')
                ->where('addresses.id',$request->shipping_address)
                ->join('countries','countries.id','=','addresses.country_id')
                ->select('unit_number as unit', 'street_number as street', 'address_line1 as line1', 'address_line2 as line2', 'city', 'country_name')
                ->first();

            Mail::send('emails.confirm-booking-bill', compact('user','shop_order','payment_method','shipping_method','shipping_address'), function($email) use($user) {
                $email->subject('Zero Food - X??c nh???n ?????t h??ng v?? thanh to??n');
                $email->to($user->email_address, $user->name);
            });

            DB::table('shopping_cart_items')->where('cart_id', '=', $cart->id )->delete();
            return redirect('/cart/prepare')->with('message', '?????t h??ng th??nh c??ng, Vui l??ng check l???i email ????? xem th??ng tin ????n h??ng!');
        }

        DB::table('shopping_cart_items')->where('cart_id', '=', $cart->id )->delete();
        return redirect('/cart/prepare')->with('message', '?????t h??ng th??nh c??ng!');
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
        // ????a ????n h??ng v??o m???c ???? h???y
        DB::update(
        'update shop_orders set order_status = 4 where id = ?', [$request->id]
        );

        $order_items = DB::table('order_lines')
        ->where ('order_id', $request->id)
        ->select('product_item_id', 'qty')
        ->get();

        // c???p nh???t l???i s??? l?????ng h??ng trong kho

        foreach($order_items as $order_item)
        {
            DB::update('
            update product_items
            set qty_in_stock = qty_in_stock + ?
            where id = ?
            ', [$order_item->qty, $order_item->product_item_id]);
        }
        
        // l???y th??ng tin c???a bill ????
        $shop_order = Shop_order::where('id', $request->id)->first();

        // G???i mail cho user x??c nh???n h???y ????n v?? ho??n l???i ti???n
        $payment= Shop_order::where('shop_orders.id',$request->id)
        ->join('user_payment_methods','user_payment_methods.id','=','shop_orders.payment_method_id')
        ->join('payment_types','payment_types.id','=','user_payment_methods.payment_type_id')
        ->select('payment_types.id')
        ->first();
        if($payment->id != 1 )
        {
            $user = User::where('id', auth()->id())->first();
            $payment_method = User_payment_method::where('user_payment_methods.id', $shop_order->payment_method_id)
                ->join('payment_types','payment_types.id', '=', 'user_payment_methods.payment_type_id')
                ->select('value', 'provider', 'account_number as number')
                ->first();
            $shipping_method = Shipping_method::where('id',$shop_order->shipping_method)->first();
            $shipping_address = DB::table('addresses')
                ->where('addresses.id',$shop_order->shipping_address)
                ->join('countries','countries.id','=','addresses.country_id')
                ->select('unit_number as unit', 'street_number as street', 'address_line1 as line1', 'address_line2 as line2', 'city', 'country_name')
                ->first();

            Mail::send('emails.cancle-bill', compact('user','shop_order','payment_method','shipping_method','shipping_address'), function($email) use($user) {
                $email->subject('Zero Food - X??c nh???n h???y ????n h??ng!');
                $email->to($user->email_address, $user->name);
            });
            
            return redirect('/cart/cancle')->with('message', 'H???y ????n h??ng th??nh c??ng, Vui l??ng check l???i email ????? xem th??ng tin ????n h??ng!');
        }

        return redirect('/cart/cancle')->with('message', '???? h???y ????n h??ng!');
    }

    public function buyAgain(Request $request)
    {
        // l???y t???t c??? c??c s???n ph???m thu???c bill ????
        $order_items = DB::table('order_lines')
        ->where ('order_id', $request->id)
        ->select('product_item_id', 'qty')
        ->get();

        // l???y gi??? h??ng
        $cart = DB::table('shopping_carts')
                ->where('user_id', auth()->id())
                ->get()
                ->first();

        // x??? l?? v???i t???ng m??n h??ng trong ????n h??ng ???? h???y
        foreach($order_items as $order_item)
        {
            // ki???m tra xem trong kho c??n h??ng kh??ng n???u kh??ng c??n th?? b??? qua lun
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
                    // n???u c?? r???i th?? c???p nh???t l???i gi??? h??ng
                    DB::update(
                        'update shopping_cart_items 
                        set qty = qty + ? 
                        where product_item_id = ?', [$order_item->qty, $order_item->product_item_id]);
                }
                else 
                {
                    // n???u kh??ng c?? s???n trong gi??? h??ng th?? t???o m???i
                    Shopping_cart_item::create([
                        'qty' => $order_item->qty,
                        'product_item_id' => $order_item->product_item_id,
                        'cart_id' => $cart->id
                    ]);
                }
                
                //gi???m s??? l?????ng th???c ??n(qty_in_stock) c?? trong product_item
                DB::update('update product_items set qty_in_stock = qty_in_stock - ? where id = ?', [$order_item->qty , $order_item->product_item_id]);
            }
        }

        // x??a ????n h??ng trong m???c ???? h???y n??y ??i
        DB::delete('
        delete from shop_orders where id =?
        ', [$request->id]);

        return redirect('/products')->with('message', 'Th??m v??o gi??? h??ng th??nh c??ng');
    }

    public function postReceive(Request $request)
    {
        // ????a ????n h??ng v??o m???c ???? mua
        DB::update(
            'update shop_orders set order_status = 5 where id = ?', [$request->id]
        );

        // th??m b??nh lu???n cho s???n ph???m

        return back()->with('message', '???? nh???n ????n h??ng!');
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
            'order_lines.id as ordered_product_id',
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

    public function reviewView(Request $request)
    {
        $items = DB::table('order_lines')
        ->where('order_lines.id', $request->id )
        ->join('product_items','product_items.id', '=', 'order_lines.product_item_id' )
        ->join('products', 'products.id', '=', 'product_items.product_id')
        ->join('product_configurations', 'product_items.id', '=', 'product_configurations.product_item_id')
        ->join('variation_options', 'variation_options.id', '=', 'product_configurations.variation_option_id')
        ->select(
        'products.id as product_id',
        'products.name as product_name', 
        'products.product_image', 
        'product_items.price', 
        'variation_options.value as variation_value'
        )
        ->get();


        return view('carts.review',[
            'item'=> $items[0],
            'ordered_product_id'=>$request->id
        ]);
    }

    public function postReview(Request $request)
    {
        $formFields = $request->validate([
            'rating_value' => ['required'],
            'comment' => ['nullable'],
        ]);

        $reviewed = User_review::select("*")
        ->where('user_id', auth()->id())
        ->where('ordered_product_id', $request->ordered_product_id )
        ->select()
        ->exists();

        // n???u ???? t???ng ????nh gi?? r???i th?? ch??? update l???i ????nh gi?? ????
        if($reviewed)
        {
            User_review::where('user_id', auth()->id())
                ->where('ordered_product_id', $request->ordered_product_id)
                ->update(['rating_value' =>  $request->rating_value,
                            'comment' => $request->comment,]);
    
            $url = '/products/'.$request->product_id;
    
            return redirect($url)->with('message', 'C???p nh???t ????nh gi?? th??nh c??ng!');
        }
        else
        {
            User_review::create([
                'user_id' => auth()->id(),
                'ordered_product_id' =>$request->ordered_product_id ,
                'rating_value' =>  $request->rating_value,
                'comment' => $request->comment,
            ]);
    
            $url = '/products/'.$request->product_id;
    
            return redirect($url)->with('message', 'Th??m ????nh gi?? th??nh c??ng!');
        }

        return back()->with('message', 'C?? l???i x???y ra!');
    }

    public function deleteReview(Request $request)
    {
        DB::delete(
        'delete from user_reviews
        where id = ?',
        [ $request ->id]
        );
        return back()->with('message', '???? x??a ????nh gi??!');
    }
}
