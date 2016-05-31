<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\CartTrait;
use App\Http\Requests;

class StaticPageController extends Controller
{
	use CartTrait;
    public function index(){
    	$cart_count = $this->countProductsInCart();
    	return view('admin.staticpage.index', compact('cart_count'));
    }
}
