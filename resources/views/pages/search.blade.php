@extends('app')
@section('content')
<div id="wrapper--">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
            @include('pages.partials.side-nav-two')
        </div>
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
            <!-- <a href="#menu-toggle" class="btn btn-default visible-xs" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a> -->
            <div class="container-fluid">
                <h6>
                {{config('label')->search_results_for}}: <i>{{ $query }}</i>
                </h6><br>
                @if (count($search_result) === 0)
                {{config('label')->no_products_found}}
                @elseif (count($search_result) >= 1)
                @foreach($search_result as $product)
                <!-- <div class="col-sm-6 col-md-3 wow zoomIn" id="product-sub-container"> -->
                <div class="col-sm-6 col-md-3 wow zoomIn" id="featured-products-sub-container">
                    <a href="{{ route('show.product', $product->product_name) }}">
                        @if ($product->photos->count() === 0)
                        <img src="{{url('/')}}/src/public/images/no-image-found.jpg" alt="No Image Found Tag" id="Product-similar-Image" style="width: 200px; height: 200px;">
                        @else
                        @if ($product->featuredPhoto)
                        <img src="{{url('/')}}/{{ $product->featuredPhoto->thumbnail_path }}" alt="Photo ID: {{ $product->featuredPhoto->id }}" />
                        @elseif(!$product->featuredPhoto)
                        <img src="{{url('/')}}/{{ $product->photos->first()->thumbnail_path}}" alt="Photo" />
                        @else
                        {{config('label')->na}}
                        @endif
                        @endif
                        <div id="featured-product-name-container">
                            <h6 class="center-on-small-only" id="featured-product-name"><br>{{ $product->product_name }}</h6>
                        </div>
                        @if($product->reduced_price == 0)
                        <div class="light-300 black-text medium-500" id="Product_Reduced-Price">{{  xformatMoney($product->price) }}</div>
                        @else
                        <div class="green-text medium-500" id="Product_Reduced-Price">{{ xformatMoney($product->reduced_price) }}</div>
                        @endif
                    </a>
                    <form action="{{url('/')}}/cart/add" method="post" name="add_to_cart">
                        {!! csrf_field() !!}
                        <input type="hidden" name="product" value="{{$product->id}}" />
                        <input type="hidden" name="weight" value="{{$product->weight}}" />
                        <input type="hidden" name="qty" value="1" />
                        <button class="btn btn-default waves-effect waves-light">{{config('label')->add_to_cart}}</button>
                    </form>
                </div>
                
                @endforeach
                @endif
            </div>
        </div>
    </div>
    @include('pages.partials.footer')
    @endsection