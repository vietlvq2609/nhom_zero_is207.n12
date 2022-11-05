<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function index()
    {
        return view(
            'products.index',
            [
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
            ->select('product_item_id as id', 'value')
            ->get();

        return view(
            'products.show',
            [
                'product_name' => $product->name,
                'product_image' => $product->product_image,
                'product_description' => $product->description,
                'product_category' => $product->product_category()->get()->first()->category_name,
                'product_options' => $products,
                'categories' => Product_category::get()
            ]
        );
    }
}
