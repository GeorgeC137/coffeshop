<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function singleProduct($id)
    {
        $product = Product::find($id);

        $relatedProducts = Product::where('type', $product->type)
            ->where('id', '!=', $id)->take('4')
            ->orderBy('id', 'desc')
            ->get();

        return view('products.product-single', compact('product', 'relatedProducts'));
    }
}
