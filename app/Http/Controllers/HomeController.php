<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Models\Product\Review;
use App\Models\Product\Product;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

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

    public function submitContact(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $contacts = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        if ($contacts) {
            return Redirect::route('contact')->with('contact', 'Contact submitted successfully');
        }
    }
}
