<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_category;
use App\Models\User_review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{


// select price, products.id
// from products, product_items, product_configurations
// where products.id = product_items.product_id
//      and product_items.product_id = product_configurations.product_item_id
// ORDER BY price

    public function index()
    {
        $product_price = DB::table('products')
            ->join('product_items', 'products.id', '=', 'product_items.product_id')
            ->join('product_configurations', 'product_items.product_id', '=', 'product_configurations.product_item_id')
            ->select('price as value','products.id as id')
            ->orderBy('price', 'asc')
            ->get();

        return view(
            'products.index',
            [
                'product_price' => $product_price,
                'products' => Product::latest()
                    ->category(request(['category']))
                    ->minprice(request(['min_price']))
                    ->maxprice(request(['max_price']))
                    ->search(request(['search']))
                    ->paginate(6)->appends(request()->query())
            ]
        );
    }

    public function show(Product $product)
    {
        $products = DB::table('products')
            ->where('products.id', $product->id)
            ->join('product_items', 'products.id', '=', 'product_items.product_id')
            ->join('product_configurations', 'product_items.id', '=', 'product_configurations.product_item_id')
            ->join('variation_options', 'variation_options.id', '=', 'product_configurations.variation_option_id')
            ->join('variations', 'variation_options.variation_id', '=', 'variations.id')
            ->select('product_item_id as id', 'value','price','qty_in_stock as qty')
            ->get();

        $reviews = DB::table('user_reviews')->latest('user_reviews.created_at')
        ->where('product_items.product_id', $product->id)
        ->join('users', 'users.id', '=' ,'user_reviews.user_id')
        ->join('order_lines', 'order_lines.id', '=', 'user_reviews.ordered_product_id')
        ->join('product_items', 'product_items.id', '=', 'order_lines.product_item_id')
        ->join('products', 'products.id', '=', 'product_items.product_id')
        ->select(
            'users.name as user_name',
            'users.avatar as avatar',
            'user_reviews.rating_value as rate',
            'user_reviews.comment as comment',
            'user_reviews.created_at',
            DB::raw('DAY(user_reviews.created_at) day, MONTH(user_reviews.created_at) month,YEAR(user_reviews.created_at) year')
            
            )
        ->paginate(10);

        $product_rate = 0;
        $review_count = 0;
        
        foreach($reviews as $review)
        {
            $product_rate += $review->rate;
            $review_count++;
        }

        if ($review_count == 0) $product_rate = 5;
        else
        // d??ng round ????? l???y gi?? tr??? l??m tr??n
            $product_rate = round($product_rate / $review_count);


        return view(
            'products.show',
            [
                'product_id' => $product->id,
                'product_name' => $product->name,
                'product_image' => $product->product_image,
                'product_description' => $product->description,
                'product_category' => $product->product_category()->get()->first()->category_name,
                'product_options' => $products,
                'categories' => Product_category::get(),
                'product_rate' => $product_rate,
                'review_count' => $review_count,
                'reviews' => $reviews,
            ]
        );
    }
}
