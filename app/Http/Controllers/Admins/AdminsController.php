<?php

namespace App\Http\Controllers\Admins;

use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use App\Models\Product\Order;
use App\Models\Product\Booking;
use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class AdminsController extends Controller
{
    public function loginPage()
    {
        return view('admins.login');
    }

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {

            return redirect()->route('admins.dashboard');
        }

        return redirect()->back()->with(['error' => 'Error logging in. Invalid credentials']);
    }

    public function index()
    {
        $productsCount = Product::select()->count();
        $ordersCount = Order::select()->count();
        $bookingsCount = Booking::select()->count();
        $adminsCount = Admin::select()->count();

        return view('admins.index', compact('productsCount', 'adminsCount', 'ordersCount', 'bookingsCount'));
    }

    public function logoutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('view.login');
    }

    public function displayAdmins()
    {
        $allAdmins = Admin::select()->orderBy('id', 'desc')->get();

        return view('admins.all-admins', compact('allAdmins'));
    }

    public function createAdmin()
    {
        return view('admins.create-admin');
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|max:40',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($admin) {
            return Redirect::route('all.admins')->with('success', 'Admin created successfully');
        }
    }

    public function displayOrders()
    {
        $allOrders = Order::select()->orderBy('id', 'desc')->get();

        return view('admins.all-orders', compact('allOrders'));
    }
    public function displayOrder($id)
    {
        $order = Order::find($id);

        return view('admins.edit-order', compact('order'));
    }

    public function updateOrder(Request $request, $id)
    {
        $order = Order::find($id);

        $order->update($request->all());

        if ($order) {
            return Redirect::route('all.orders')->with('updated', 'Order status updated successfully');
        }
    }

    public function deleteOrder($id)
    {
        $order = Order::find($id);

        $order->delete();

        if ($order) {
            return Redirect::route('all.orders')->with('deleted', 'Order deleted successfully');
        }
    }

    public function displayProducts()
    {
        $products = Product::select()->orderBy('id', 'desc')->get();

        return view('admins.all-products', compact('products'));
    }

    public function createProduct()
    {
        return view('admins.create-product');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|max:40',
            'price' => 'required',
            'description' => 'required',
            'image' => 'required|image',
        ]);

        $destinationPath = 'assets/images/';
        $myimage = $request->image->getClientOriginalName();
        $request->image->move(public_path($destinationPath), $myimage);

        $product = Product::create([
            'name' => $request->name,
            'type' => $request->type,
            'image' => $myimage,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        if ($product) {
            return Redirect::route('all.products')->with('success', 'Product created successfully');
        }
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);

        if(File::exists(public_path('assets/images/' . $product->image))){
            File::delete(public_path('assets/images/' . $product->image));
        }else{
            //dd('File does not exists.');
        }

        $product->delete();

        if ($product) {
            return Redirect::route('all.products')->with('deleted', 'Product deleted successfully');
        }
    }
}
