@extends('app')
@section('content')
<div id="wrapper--">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
            @include('pages.partials.side-nav-two')
        </div>
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
            <div class="container-fluid">
                <h4 class="h4-responsive">{{config('label')->your_cart}}</h4><br>
                @include('cart.partials.cart_table')
                @if ($cart_total === 0)
                <a href="{{ url('/') }}" class="btn btn-primary">{{config('label')->continue_shopping}}</a>
                @else
                <a href="{{ url('/') }}" class="btn btn-primary">{{config('label')->continue_shopping}}</a>
                <a href="{{ route('checkout') }}" class="btn btn-default">{{config('label')->checkout}}</a>
                @endif
                <br><br><br>
            </div>
        </div>
    </div>
    @include('pages.partials.footer')
    @stop