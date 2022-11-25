<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_category;
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
                    ->paginate(6)
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
            ]
        );
    }
}
