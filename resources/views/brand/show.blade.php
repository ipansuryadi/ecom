@extends('app')
@section('content')
<div id="wrapper--">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
            <div id="sidebar-wrapper-two">
                <ul class="sidebar-nav" style="padding-top: 20px;width:100%;position:relative;">
                    <li class="green-text bold-700">{{config('label')->brand}}</li>
        <div class="li-brand">
            @foreach ($brand as $b)
            <li>
                <a href="{{ url('brand', $b->id) }}">
                    {{ $b->brand_name }}
                </a>
            </li>
            @endforeach
        </div>
                    <br><br>
                    <li class="green-text bold-700">{{config('label')->category}}</li>
                    @foreach($category as $cat)
                    <li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                {{ $cat->category }} <span class="caret"></span>
                                <ul class="dropdown-menu">
                                    @foreach($cat->children as $children)
                                    <li id="dropdown-category">
                                        <a href="{{ url('category', $children->id) }}">
                                            {{ $children->category }}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </a>
                        </li>
                    </li>
                    @endforeach
                    <br><br>
                </ul>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
            <!-- <a href="#menu-toggle" class="btn btn-default visible-xs" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a> -->
            <div class="container-fluid">
                <h3 class="text-center">
                @foreach($brands as $brand)
                {{ $brand->brand_name }}
                @endforeach
                </h3>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">{{config('label')->sort_by}}
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('brand.newest', $brand->id) }}">{{config('label')->newest}}</a></li>
                        <li><a href="{{ route('brand.lowest', $brand->id) }}">{{config('label')->price_lowest}}</a></li>
                        <li><a href="{{ route('brand.highest', $brand->id) }}">{{config('label')->price_highest}}</a></li>
                        <li><a href="{{ route('brand.alpha.lowest', $brand->id) }}">{{config('label')->product_a_z}}</a></li>
                        <li><a href="{{ route('brand.alpha.highest', $brand->id) }}">{{config('label')->product_z_a}}</a></li>
                    </ul>
                </div>
                <br>
                <p>{{ $count }} {{ str_plural('product', $count) }}</p>
                <div class="row">
                    @foreach($products as $product)
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
                </div>
            </div>
        </div>
    </div>
    @include('pages.partials.footer')
    @endsection
    