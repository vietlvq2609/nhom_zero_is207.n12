<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;

class AdminController extends Controller
{
    // Render admin view
    public function index() {
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
        ->select('name', 'avatar', 'email_address','phone_number')
        ->get();
        return view('admin.users', [
            'users' => $users
        ]);
    }


    // insert 
    public function addUser(Request $request)
    {
        
        $formfield = $request->validate([
            'name' => 'required',
            'email_address' => 'required',
            'phone_number' =>'required',
            'password' => 'required',
            'avatar' => 'required',
        ]);

        // Hash Password
        $formfield['password'] = bcrypt($formfield['password']);

        User::create($formfield);

        return back()->with('message',"Thêm thành công");
    }

    // update
    

    //delete
    public function deleteUser(Request $request)
    {
       DB::delete('delete from users where id = ?', [ $request->user_id ]);
        return back()->with('message',"Xóa thành công");
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
        ->select('products.name','order_lines.order_id', 'order_lines.qty', 'order_lines.price')
        ->get();
        return view('admin.orders', [
            'orders' => $orders
        ]);
    }
    

}
