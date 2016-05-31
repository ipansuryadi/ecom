@extends('app')

@section('content')
<div id="wrapper--">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
            @include('pages.partials.side-nav-two')
        </div>
<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                <!-- Button to toggle side-nav -->
        <!-- <a href="#menu-toggle" class="btn btn-default visible-xs" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a> -->

        <div class="container-fluid">

            <h4 class="h4-responsive">{{config('label')->checkout}}</h4><br>

            @include('cart.partials.cart_checkout_table')


            <a href="{{ url('/') }}" class="btn btn-primary">{{config('label')->continue_shopping}}</a>
            <a href="{{ route('cart') }}" class="btn btn-default">{{config('label')->cart}}</a>

            <!-- include('cart.partials.shipping_payment') -->
            @include('cart.partials.pick_address')

        </div>  <!-- close container -->
        </div>
        </div>
    </div>  <!-- close wrapper -->
@include('pages.partials.footer')
@stop

