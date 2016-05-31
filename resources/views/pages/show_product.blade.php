@extends('app')

@section('content')

    <div id="wrapper--">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
        @include('pages.partials.side-nav-two')
        </div>
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
        <!-- <a href="#menu-toggle" class="btn btn-default visible-xs" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a> -->
        <a href="#" onclick="window.history.back();return false;" class="btn btn-warning" id="menu-toggle"><i class="fa fa-arrow-left fa-5x" aria-hidden="true"></i></a>

        <div class="container-fluid">

            <div class="col-md-12">

                <div class="col-xs-12 col-sm-12 col-md-6 gallery">
                    @if ($product->photos->count() === 0)
                        <p>{{config('label')->no_images_found_for_this_product}}.</p><br>
                        <img src="{{url('/')}}/src/public/images/no-image-found.jpg" alt="No Image Found Tag" id="Product-similar-Image">
                    @else
                        @foreach ($product->photos->slice(0, 8) as $photo)
                        @if ($photo->featured == "1")
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <img src="{{url('/')}}/{{ $photo->path }}" alt="Photo ID: {{ $photo->id  }}" data-id="{{ $photo->id }}" class="img-responsive">
                            </div>
                        @endif
                        @endforeach
                        @foreach ($product->photos->slice(0, 8) as $photo)
                            <div class="col-xs-6 col-sm-4 col-md-3 gallery_image text-center">
                                <a href="{{url('/')}}/{{ $photo->path }}" data-lity>
                                    <img src="{{url('/')}}/{{ $photo->thumbnail_path }}" alt="Photo ID: {{ $photo->id  }}" data-id="{{ $photo->id }}" class="img-thumbnail">
                                </a>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="col-sm-12 col-md-6">
                    <h5 id="Product_Name">{{ $product->product_name }}</h5>
                    <p id="Product_Brand">{{config('label')->brand}}: {{ $product->brand->brand_name }}</p>
                    <p id="Product_ISBN">ISBN: {{ $product->product_sku }}</p>
                    <br>
                    @if($product->reduced_price == 0)
                        <div class="light-300 black-text medium-500" id="Product_Reduced-Price">{{  xformatMoney($product->price) }}</div>
                        <br>
                    @else
                        <div class="discount light-300 black-text medium-500" id="Product_Reduced-Price"><s>{{ xformatMoney($product->price) }}</s></div>
                        <div class="green-text medium-500" id="Product_Reduced-Price">{{ xformatMoney($product->reduced_price) }}</div>
                    @endif
                    <hr>

                    @if ($product->product_qty == 0)
                        <h5 class="text-center red-text">{{config('label')->sold_out}}</h5>
                        <p class="text-center"><b>Available: {{ $product->product_qty }}</b></p>
                    @else
                        <form action="{{url('/')}}/cart/add" method="post" name="add_to_cart">
                            {!! csrf_field() !!}
                            <input type="hidden" name="product" value="{{$product->id}}" />
                            <input type="hidden" name="weight" value="{{$product->weight}}" />
                            <label>{{config('label')->qty}}</label>
                            <select name="qty" class="form-control" id="Product_QTY" title="Product Quantity">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>

                            <br><br>

                            <p><b>{{config('label')->available}}: {{ $product->product_qty }}</b></p>

                            <button class="btn btn-default waves-effect waves-light">{{config('label')->add_to_cart}}</button>
                        </form>
                    @endif

                </div>

            </div>


            <div class="col-md-12">

                <div class="col-sm-12 col-md-12" id="Product-Description-Container">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#product_description" aria-controls="home" role="tab" data-toggle="tab">{{config('label')->description}}</a></li>
                        <li role="presentation"><a href="#product_spec" aria-controls="profile" role="tab" data-toggle="tab">{{config('label')->specs}}</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="product_description">
                            {!! $product->description !!}
                        </div>
                        <div role="tabpanel" class="tab-pane" id="product_spec">
                            {!! $product->product_spec !!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-12" id="Similar-Products-Container">

                    <h6 class="text-center">{{config('label')->similar_product}}</h6><br>

                    @foreach($similar_product->slice(0, 4) as $similar)
                        <div class="col-xs-6 col-md-3 text-center" id="Similar-Product-Sub-Container">
                            <a href="{{ route('show.product', $similar->product_name) }}">
                                @if ($similar->photos->count() === 0)
                                    <p id="Similar-Title">{{ str_limit($similar->product_name, $limit = 28, $end = '...') }}</p>
                                    <img src="{{url('/')}}/src/public/images/no-image-found.jpg" alt="No Image Found Tag" id="Product-similar-Image">
                                @else
                                    @if ($similar->featuredPhoto)
                                        <p id="Similar-Title">{{ str_limit($similar->product_name, $limit = 28, $end = '...') }}</p>
                                        <img src="{{url('/')}}/{{ $similar->featuredPhoto->thumbnail_path }}" alt="Photo ID: {{ $similar->featuredPhoto->id }}" id="Product-similar-Image" />
                                    @elseif(!$similar->featuredPhoto)
                                        <p id="Similar-Title">{{ $similar->product_name }}</p>
                                        <img src="{{url('/')}}/{{ $similar->photos->first()->thumbnail_path}}" alt="Photo" id="Product-similar-Image" />
                                    @else
                                        {{config('label')->na}}
                                    @endif
                                @endif
                            </a>
                        </div>
                    @endforeach

                </div>

            </div>

            <br><br><hr>

        </div>
        </div>


    </div>
@include('pages.partials.footer')

@stop