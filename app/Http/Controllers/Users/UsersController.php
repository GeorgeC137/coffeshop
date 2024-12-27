<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Models\Product\Order;
use App\Models\Product\Review;
use App\Models\Product\Booking;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    public function displayBookings()
    {
        $bookings = Booking::select()->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();

        return view('users.bookings', compact('bookings'));
    }

    public function displayOrders()
    {
        $orders = Order::select()->where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();

        return view('users.orders', compact('orders'));
    }

    public function writeReview()
    {
        return view('users.reviews');
    }

    public function postReview(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'review' => 'required',
        // ]);

        $review = Review::create([
            'name' => Auth::user()->name,
            'review' => $request->review
        ]);

        if ($review) {
            return Redirect::route('reviews')->with('review', 'Your review was submitted successfully');
        }
    }
}
