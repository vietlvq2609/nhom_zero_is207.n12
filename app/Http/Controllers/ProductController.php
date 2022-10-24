<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Product_category;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        return view(
            'products.index',
            [
                'products' => Product::latest()->filter(request(['category', 'price']))->paginate(6),
                'categories' => Product_category::get()
            ]
        );
    }
    public function show(Product $product)
    {
        return view(
            'products.show',
            [
                'product' => $product,
                'product_category' => $product->product_category()
                    ->where('id', $product->category_id)
                    ->get('category_name')->first(),
                'product_items' => $product->product_item()
                    ->where('product_id', $product->id),
                'categories' => Product_category::get()
            ]
        );
    }
}
