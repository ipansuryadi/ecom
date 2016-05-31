<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Requests\configRequest;
use App\Http\Traits\CartTrait;
use Illuminate\Support\Facades\File;

use App\Http\Requests;

class ConfigController extends Controller
{
	use CartTrait;

    public function index(){
    	// return config('label')->register;
    	$cart_count = $this->countProductsInCart();
    	$file = File::get(config_path().'/configuration.json');
    	$configs = json_decode($file);
    	return view('admin.config.index', compact('cart_count', 'configs'));
    }

    public function store(Request $request){
    	$cart_count = $this->countProductsInCart();
    	$input = $request->except(['_token']);
    	File::put(config_path().'/configuration.json',json_encode($input));
    	flash()->success('Success', 'Configuration set');
    	return redirect()->back();
    }
}
