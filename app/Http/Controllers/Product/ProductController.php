<?php

namespace App\Http\Controllers\Product;

use App\Models\Product\Cart;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function singleProduct($id)
    {
        $product = Product::find($id);

        $relatedProducts = Product::where('type', $product->type)
            ->where('id', '!=', $id)->take('4')
            ->orderBy('id', 'desc')
            ->get();

        // Checking products in cart(cartItems)
        $cartItems = Cart::where('prod_id', $id)
            ->where('user_id', Auth::user()->id)
            ->count();

        return view('products.product-single', compact('product', 'relatedProducts', 'cartItems'));
    }

    public function addToCart(Request $request, $id)
    {
        $cartItems = Cart::create([
            'prod_id' => $request->prod_id,
            'name' => $request->name,
            'image' => $request->image,
            'price' => $request->price,
            'user_id' => Auth::user()->id,
        ]);

        // echo 'item added to cart';

        return Redirect::route('single.product', $id)->with('success', 'Product added to cart successfully');
    }

    public function cart()
    {
        $cartProducts = Cart::where('user_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();

        $totalPrice = Cart::where('user_id', Auth::user()->id)
            ->sum('price');

        return view('products.cart', compact('cartProducts', 'totalPrice'));
    }

    public function deleteFromCart($id)
    {
        $deletedCartProduct = Cart::where('prod_id', $id)
            ->where('user_id', Auth::user()->id);

        $deletedCartProduct->delete();

        if ($deletedCartProduct) {
            return Redirect::route('cart')->with('delete', 'Product deleted from cart successfully');
        }
    }
}
