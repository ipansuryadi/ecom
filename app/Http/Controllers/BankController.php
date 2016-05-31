<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\BankRequest;
use App\Bank;
use App\Http\Traits\CartTrait;
use Illuminate\Support\Facades\Input;

class BankController extends Controller
{
	use CartTrait;

    public function index(){
    	$cart_count = $this->countProductsInCart();
    	$banks = Bank::all();
    	return view('admin.bank.index', compact('banks','cart_count'));
    }

    public function create(){
    	$cart_count = $this->countProductsInCart();
    	return view('admin.bank.create', compact('cart_count'));
    }

    public function store(BankRequest $request){
    	// return dd(Input::all());
    	$bank = new Bank($request->all());
    	$bank->save();
    	flash()->success('Success', 'Bank added successfully!');
    	return redirect()->route('admin.bank.index');
    }

    public function edit($id){
    	$bank = Bank::findOrFail($id);
    	$cart_count = $this->countProductsInCart();
    	return view('admin.bank.edit', compact('bank','cart_count'));
    }

    public function update($id, BankRequest $request){
    	$bank = Bank::findOrFail($id);
    	$bank->update($request->all());
    	flash()->success('Success', 'Bank updated successfully!');
    	return redirect()->route('admin.bank.index');
    }

    public function destroy($id){
    	$bank = Bank::findOrFail($id);
    	$bank->delete();
    	return redirect()->back();
    }
}