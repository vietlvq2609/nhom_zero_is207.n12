<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
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
        $value = new User();
        $value->name = $request['name'];
        $value->avatar = $request['avatar'];
        $value->email_address = $request['email'];
        $value->password = $request['password'];
        $value->phone_number = $request['phone'];

        $value['password'] = bcrypt($value['password']);

        // DB::table('users')->insert([
        //     'name' => $value['name'],
        //     'avatar' => $value['avatar'],
        //     'email_address' => $value['email_address'],
        //     'password' => $value['password'],
        //     'phone_number' => $value['phone_number']
        // ]);

        $value->save();

        return redirect('admin/user')->with('message', "Inserted");
    }

    // update
    public function loadEditForm(User $id)
    {
        return view('admin.editUser', [
            "user" => $id
        ]);
    }

    //delete
    public function deleteUser(Request $request)
    {
        DB::delete('delete from users where id = ?', [$request->user_id]);
        return back()->with('message', "Xóa thành công");
    }

    // Products
    public function products()
    {
        $products = DB::table('products')
            ->join('product_categories', 'products.category_id', '=', 'product_categories.id')
            ->select('product_categories.category_name', 'name', 'description', 'product_image')
            ->get();
        return view('admin.products', [
            'products' => $products
        ]);
    }

    // Orders
    public function orders()
    {
        $orders = DB::table('order_lines')
            ->join('products', 'order_lines.product_item_id', '=', 'products.id')
            ->select('products.name', 'order_lines.order_id', 'order_lines.qty', 'order_lines.price')
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
            ->join('payment_types', 'shop_orders.payment_method_id', '=', 'payment_types.id')
            ->join('shipping_methods', 'shop_orders.shipping_method', '=', 'shipping_methods.id')
            ->join('order_statuses', 'shop_orders.order_status', '=', 'order_statuses.id')
            ->select(
                'users.name as name_user',
                'payment_types.value as name_type',
                'shop_orders.shipping_address',
                'shipping_methods.name as name_method',
                'order_statuses.status as name_status',
                'shop_orders.order_date',
                'shop_orders.order_total'
            )
            ->get();
        return view('admin.shoppings', [
            'shoppings' => $shoppings
        ]);
    }
}
