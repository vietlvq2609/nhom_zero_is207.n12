<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use App\Models\Shopping_cart;
use App\Models\User_role;
use App\Models\Product_category;
use Illuminate\Support\Facades\Redis;
use Symfony\Component\HttpFoundation\RateLimiter\RequestRateLimiterInterface;

class AdminController extends Controller
{
    // Render admin view
    public function index()
    {
        // Count user, products, orders
        $users = DB::table('users')
            ->count('*');

        $products = DB::table('products')
            ->count('*');

        $orders = DB::table('order_lines')
            ->count('*');

        $shoppings = DB::table('shop_orders')
            ->count('*');

        return view('admin.index', [
            'user_count' => $users,
            'product_count' => $products,
            'order_count' => $orders,
            'shopping_count' => $shoppings
        ]);
    }

    // Admin User
    public function users()
    {
        
        $users = DB::table('users')
            ->select('id', 'name', 'avatar', 'email_address', 'phone_number')
            ->get();
        return view('admin.users', [
            'users' => $users
        ]);
    }


    // insert 
    public function createUser()
    {
        return view('admin.createUser');
    }

    public function insertUser(Request $request)
    {
        $user = new User();
        $user->name = $request['name'];
        $user->avatar = $request['avatar'];
        $user->email_address = $request['email'];
        $user->password = $request['password'];
        $user->phone_number = $request['phone'];

        // Add role "user" for user
        User_role::create([
            'user_id' => $user->id,
            'role_id' => 2
        ]);

        // Add cart for user
        Shopping_cart::create([
            'user_id' => $user->id
        ]);

        $user['password'] = bcrypt($user['password']);

        // DB::table('users')->insert([
        //     'name' => $value['name'],
        //     'avatar' => $value['avatar'],
        //     'email_address' => $value['email_address'],
        //     'password' => $value['password'],
        //     'phone_number' => $value['phone_number']
        // ]);

        $user->save();

        return redirect('admin/user')->with('message', "Th??m th??nh c??ng");
    }

    // update
    public function loadEditForm(User $id)
    {
        return view('admin.editUser', [
            "user" => $id,
        ]);
    }

    public function updateUser(Request $request, $id)
    {

        DB::table('users')
        ->where('id', '=', $id)
        ->update( [
            'name' => $request['name'],
            'avatar' => $request['avatar'],
            'email_address' => $request['email'],
            'phone_number' => $request['phone'],
        ]);

        return redirect('admin/user')->with('message', "S???a th??nh c??ng");
    }



    //delete
    public function destroyUser($id)
    {
        DB::table('users')->where('id', '=', $id)->delete();
        return back()->with('message', "X??a th??nh c??ng");
    }

    // Products
    public function products()
    {
        $products = DB::table('products')
            ->join('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->select('products.id', 'product_categories.category_name', 'name', 'description', 'product_image')
            ->get();
        return view('admin.products', [
            'products' => $products
        ]);
    }

    // insert
    public function createProduct()
    {
        return view('admin.createProduct');
    }

    public function insertProduct(Request $request)
    {   

        $value = new Product();
        $value->category_id = $request->type_id;
        $value->name = $request->name;
        $value->description = $request->description;
        $value->product_image = $request->image;

        $value->save();
        return redirect('admin/products')->with('message', "S???a th??nh c??ng");
    }

    // update
    public function loadEditProduct(Product $id)
    {
        $categories = DB::table('product_categories')
        ->select('*')->get();
        return view('admin.editProduct', [
            "product" => $id,
            'categories' => $categories
        ]);
    }

    public function updateProduct(Request $request, $id)
    {
        
        DB::table('products')
        ->where('id', '=', $id)
        ->update([
            'category_id' => $request['type_id'],
            'name' => $request['name'],
            'description' => $request['description'],
            'product_image' => $request['image']
        ]);

        
        
        return redirect('admin/products')->with('message', "S???a th??nh c??ng");
    }

    // delete
    public function destroyProduct($id)
    {
        DB::table('products')->where('id', '=', $id)->delete();
        return back()->with('message', "X??a th??nh c??ng");
    }

    // Orders
    public function orders()
    {
        $orders = DB::table('order_lines')
            ->join('product_items', 'order_lines.product_item_id', '=', 'product_items.id')
            ->join('products', 'product_items.product_id', '=', 'products.id')
            ->select('order_lines.id', 'products.name', 'order_lines.order_id', 'order_lines.qty', 'order_lines.price')
            ->get();
        return view('admin.orders', [
            'orders' => $orders
        ]);
    }

    // Shoppings
    public function shoppings()
    {
        $shoppings = DB::table('shop_orders')
        ->join('users', 'shop_orders.user_id', '=', 'users.id')
        ->join('user_payment_methods','user_payment_methods.id','=','shop_orders.payment_method_id')
        ->join('payment_types', 'user_payment_methods.payment_type_id', '=', 'payment_types.id')
        ->join('addresses', 'shop_orders.shipping_address', '=', 'addresses.id')
        ->join('countries','countries.id', '=', 'addresses.country_id')
        ->join('shipping_methods', 'shop_orders.shipping_method', '=', 'shipping_methods.id')
        ->join('order_statuses', 'shop_orders.order_status', '=', 'order_statuses.id')
        ->select('shop_orders.id',
        'users.name as name_user', 
        'payment_types.value as name_payment_type', 
        'addresses.unit_number as unit',
        'addresses.street_number as street',
        'addresses.address_line1 as address1',
        'addresses.address_line2 as address2',
        'addresses.city',
        'countries.country_name',
        'shipping_methods.name as name_ship_method', 
        'order_statuses.status as name_status', 
        'shop_orders.order_date', 
        'shop_orders.order_total')
        ->get();
        return view('admin.shoppings', [
            'shoppings' => $shoppings
        ]);
    }
    // Edit Status
    public function editStatus($id)
    {
        
        
    }
}
