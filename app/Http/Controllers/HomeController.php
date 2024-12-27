<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\Review;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::select()->orderBy('id', 'desc')->take('4')->get();
        $reviews = Review::select()->orderBy('id', 'desc')->take('4')->get();

        return view('home', compact('products', 'reviews'));
    }

    public function about()
    {
        $reviews = Review::select()->orderBy('id', 'desc')->take('4')->get();
        return view('pages.about', compact('reviews'));
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function services()
    {
        return view('pages.services');
    }
}
