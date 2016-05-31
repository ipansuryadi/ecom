<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ShippingRequest;
use App\Shipping;
use App\Http\Traits\CartTrait;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;

class ShippingController extends Controller
{
	use CartTrait;

    public function index(){
    	$cart_count = $this->countProductsInCart();
    	$shipping = Shipping::paginate(30);
    	$search = Shipping::all();
    	return view('admin.shipping.index',compact('cart_count', 'shipping', 'search'));
    }

    public function search(){
    	$cart_count = $this->countProductsInCart();
    	$query = Input::get('search');
    	$shipping = Shipping::where('location', 'LIKE', '%' . $query . '%')->paginate(30);
    	$search = Shipping::all();
    	return view('admin.shipping.search', compact('cart_count', 'shipping', 'search'));
    }

    public function edit($id){
        $cart_count = $this->countProductsInCart();
        $shipping = Shipping::findOrFail($id);
        return view('admin.shipping.edit',compact('cart_count', 'shipping'));
    }

    public function update($id, ShippingRequest $request){
        $shipping = Shipping::findOrFail($id);
        $shipping->update($request->all());
        flash()->success('Success', 'Shipping update successfully!');
        return redirect()->route('admin.shipping.index');
    }
}
