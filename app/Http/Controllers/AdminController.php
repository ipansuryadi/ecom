<?php

namespace App\Http\Controllers;

use App\Slideshow;
use App\Cart;
use App\User;
use App\Order;
use App\Product;
use App\Payment;
use Illuminate\Http\Request;
use App\Http\Traits\CartTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

class AdminController extends Controller {

    use CartTrait;


    /**
     * Show the Admin Dashboard
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        // return redirect()->route('admin.pages.order');

        // From Traits/CartTrait.php
        // ( Count how many items in Cart for signed in user )
        $cart_count = $this->countProductsInCart();
        
        // Get all the orders in DB
        $orders = Order::all();

        // Get the grand total of all totals in orders table
        $count_total = Order::sum('total');

        // Get all the users in DB
        $users = User::all();
        
        
        // Get all the carts in DB
        $carts = Cart::all();

        // Get all the carts in DB
        $products = Product::all();
        
        // Select all from Products where the Product Quantity = 0
        $product_quantity = Product::where('product_qty', '<=', 1)->get();

        return view('admin.pages.index', compact('cart_count', 'orders', 'users', 'carts', 'count_total', 'products', 'product_quantity'));
    }
    
    public function user(){
        $cart_count = $this->countProductsInCart();
        $users = User::all();
        $count = User::count();
        return view('admin.pages.user',compact('cart_count','users', 'count'));
    }
    
    /**
     * Delete a user
     * 
     * @param $id
     * @return mixed
     */
    public function delete($id) {

        // Find the product id and delete it from DB.
        $user = User::findOrFail($id);

        if (Auth::user()->id == 2) {
            // If user is a test user (id = 2),display message saying you cant delete if your a test user
            flash()->error('Error', 'Cannot delete users because you are signed in as a test user.');
        } elseif ($user->admin == 1) {
            // If user is a admin, don't delete the user, else delete a user
            flash()->error('Error', 'Cannot delete Admin.');
        } else {
            $user->delete();
        }

        // Then redirect back.
        return redirect()->back();
    }


    /** Delete a cart session
     * 
     * @param $id
     * @return mixed
     */
    public function deleteCart($id) {
        // Find the product id and delete it from DB.
        $cart = Cart::findOrFail($id);

        if (Auth::user()->id == 2) {
            // If user is a test user (id = 2),display message saying you cant delete if your a test user
            flash()->error('Error', 'Cannot delete cart because you are signed in as a test user.');
        } else {
            $cart->delete();
        }

        // Then redirect back.
        return redirect()->back();
    }


    /**
     * Update the Product Quantity if empty for Admin dashboard
     * 
     * @param Request $request
     * @return mixed
     */
    public function update(Request $request) {

        // Validate email and password.
        $this->validate($request, [
            'product_qty' => 'required|max:2|min:1',
        ]);

        // Set the $qty to the quantity inserted
        $qty = Input::get('product_qty');

        // Set $product_id to the hidden product input field in the update cart from
        $product_id = Input::get('product');

        // Find the ID of the products in the Cart
        $product = Product::find($product_id);

        $product_qty = Product::where('id', '=', $product_id);

        if (Auth::user()->id == 2) {
            // If user is a test user (id = 2),display message saying you cant delete if your a test user
            flash()->error('Error', 'Cannot update product quantity because you are signed in as a test user.');
        } else {
            // Update your product qty
            $product_qty->update(array(
                'product_qty' => $qty
            ));
        }


        return redirect()->back();
        
    }

    public function order(){
        $cart_count = $this->countProductsInCart();
        
        $now = Carbon::now();
        $check_expired = Order::where('created_at','<', $now->subDays(3))->where('status','unpaid')->get();
        if ($check_expired) {
            foreach ($check_expired as $value) {
                foreach ($value->orderItems as $element) {
                    Product::where('id',$element->pivot->product_id)->increment('product_qty', $element->pivot->qty);
                    Product::where('id',$element->pivot->product_id)->decrement('buy', $element->pivot->qty);
                }
                $delete = Order::findOrFail($value->id);
                $delete->delete();
            }

        }
        $orders = Order::all();
        $count = Order::count();
        $status = Order::distinct()->select('status')->get();
        return view('admin.pages.order', compact('cart_count', 'orders', 'count', 'status'));
    }

    public function status($status){
        $cart_count = $this->countProductsInCart();
        $orders = Order::where('status',$status)->get();
        $count = Order::count();
        $status = Order::distinct()->select('status')->get();
        return view('admin.pages.order', compact('cart_count', 'orders', 'count', 'status'));
    }



    public function orderVerify($id){
        $cart_count = $this->countProductsInCart();
        $payment = Payment::where('order_id',$id)->get();
        return view('admin.pages.verify', compact('cart_count','payment'));
    }

    public function postOrderVerify(Request $request){
        $payment = Payment::where('id',Input::get('payment_id'))->update(['status'=>'verified']);
        $order = Order::where('id',Input::get('order_id'))->update(['status'=>'paid - waiting for delivery']);
        flash()->success('Success', 'Order verification success...');
        return redirect()->route('admin.pages.order');
    }

    public function orderDelivery($id){
        $cart_count = $this->countProductsInCart();
        $orders = Order::where('id',$id)->get();
        return view('admin.pages.delivery', compact('cart_count', 'orders'));
    }

    public function postOrderDelivery(Request $request){
        $data = [
            'ongkir_real'=>Input::get('ongkir_real'),
            'kurir'=>Input::get('kurir'),
            'no_resi'=>Input::get('no_resi'),
            'status'=>'delivery',
        ];
        $order = Order::where('id',Input::get('order_id'))->update($data);
        flash()->success('Success', 'Order delivery success...');
        return redirect()->route('admin.pages.order');
    }

    public function finishTransaction(Request $request){
        $order = Order::where('id',Input::get('order_id'))->update(['status'=>'finished']);
        flash()->success('Success', 'Order finished...');
        return redirect()->route('admin.pages.order');
    }


}