<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Input;
use App\Http\Requests\SlideshowRequest;

use App\Slideshow;
use App\User;
use App\Http\Traits\CartTrait;

class SlideshowController extends Controller
{
	use CartTrait;

    public function index(){
    	$cart_count = $this->countProductsInCart();
        $slideshows = Slideshow::orderBy('order','asc')->orderBy('updated_at','desc')->get();
        return view('admin.slideshow.index',compact('cart_count','slideshows'));
    }

    public function add(){
    	$cart_count = $this->countProductsInCart();
    	return view('admin.slideshow.add',compact('cart_count','users'));
    }

    public function post(SlideshowRequest $request){
    	// return dd(Input::all());
    	$name = sha1 ( time() . $request->file('image_name')->getClientOriginalName() );
        $extension = $request->file('image_name')->getClientOriginalExtension();
        $new_name = $name.'.'.$extension;
        $base_dir = 'src/public/Slideshows/';
        $img = \Image::make($request->file('image_name'));
        $img->fit(1920, 384, function($constraint){
        	$constraint->aspectRatio();
        });
        $img->save($base_dir . $new_name);
        Slideshow::create([
        	'image_name'=>$new_name,
        	'title'=>$request->input('title'),
        	'short_desc'=>$request->input('short_desc'),
        	'link'=>$request->input('link'),
        	'order'=>$request->input('order'),
        	]);
        return redirect()->route('admin.slideshow.index');
    }

    public function edit($id){
    	$cart_count = $this->countProductsInCart();
    	$slideshow = Slideshow::find($id);
    	return view('admin.slideshow.edit',compact('slideshow', 'cart_count'));
	}
    public function update($id, Request $request){
    	$slideshow = Slideshow::findOrFail($id);
    	$slideshow->update($request->all());
    	
    	// $slideshow->update($data);
    	return redirect()->route('admin.slideshow.index');
    }

    public function delete($id){
    	$slideshow = Slideshow::findOrFail($id);
        $slideshow->delete();
        return redirect()->route('admin.slideshow.index');
    }
}
