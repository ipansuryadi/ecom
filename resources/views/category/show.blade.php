@extends('app')
@section('content')
<div id="wrapper--">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
            @include('pages.partials.side-nav-two')
        </div>
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
            <div class="container-fluid">
                <h3 class="text-center">
                @foreach($categories as $category)
                {{ $category->category }}
                @endforeach
                </h3>
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">{{config('label')->sort_by}}
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('category.newest', $category->id) }}">{{config('label')->newest}}</a></li>
                        <li><a href="{{ route('category.lowest', $category->id) }}">{{config('label')->price_lowest}}</a></li>
                        <li><a href="{{ route('category.highest', $category->id) }}"> {{config('label')->price_highest}}</a></li>
                        <li><a href="{{ route('category.alpha.lowest', $category->id) }}">{{config('label')->product_a_z}}</a></li>
                        <li><a href="{{ route('category.alpha.highest', $category->id) }}">{{config('label')->product_z_a}}</a></li>
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
</div>
@endsection
@section('footer')
@endsection