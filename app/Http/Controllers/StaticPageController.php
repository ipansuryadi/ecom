<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\CartTrait;
use Illuminate\Support\Facades\File;
use App\Http\Requests;

class StaticPageController extends Controller
{
	use CartTrait;
    private $page_location = 'src/public/staticpage/page/';
    private $image_location = 'src/public/staticpage/image/';
    public function index(){
    	$cart_count = $this->countProductsInCart();
        $files = File::files($this->page_location);
        foreach($files as $file)
        {
            $pages[] = pathinfo($file);
        }
    	return view('admin.staticpage.index', compact('cart_count','pages'));
    }

    public function create(){
    	$cart_count = $this->countProductsInCart();
    	return view('admin.staticpage.create', compact('cart_count'));	
    }

    public function store(Request $request){
        $contents = [
            'page_title'=>$request->input('page_title'),
            'page_description'=>$request->input('page_description')
        ];
        File::put($this->page_location.str_slug($request->input('page_title')), json_encode($contents));
        $cart_count = $this->countProductsInCart();
        return view('admin.staticpage.index', compact('cart_count'));
    }

    public function upload(Request $request){
        $name = sha1 ( time() . $request->file('file')->getClientOriginalName() );
        $extension = $request->file('file')->getClientOriginalExtension();
        $new_name = $name.'.'.$extension;
        $base_dir = $this->image_location;
        $img = \Image::make($request->file('file'));
        $img->save($base_dir . $new_name);
        $link = ['link'=> url('/').'/'.$base_dir . $new_name];
        $return = stripslashes(json_encode($link));
        return $return;
    }

    public function edit($static){
        // return $static;
        $file = File::get($this->page_location.$static);
        $cart_count = $this->countProductsInCart();
        $page = json_decode($file);
        return view('admin.staticpage.edit', compact('cart_count','page'));
    }

    public function update(Request $request, $static){
        $contents = [
            'page_title'=>$request->input('page_title'),
            'page_description'=>$request->input('page_description')
        ];
        File::put($this->page_location.str_slug($static), json_encode($contents));
        return redirect()->route('admin.static.index');
    }
}
