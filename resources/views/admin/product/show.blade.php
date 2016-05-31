@extends('admin.dash')

@section('content')
    <div class="container-fluid" id="admin-product-container">
        <a href="#menu-toggle" class="btn btn-default visible-xs" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a>
        @include('admin.product.partials.search_box')
        <a href="{{ url('admin/product/add') }}" class="btn btn-primary">Add new Product</a>
        <div class="dropdown pull-right">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Sort by
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
                <li><a href="{{ route('admin.product.newest', $brand_query) }}">Newest</a></li>
                <li><a href="{{ route('admin.product.oldest', $brand_query) }}">Oldest</a></li>
                <li><a href="{{ route('admin.product.highest', $brand_query) }}">Price Highest</a></li>
                <li><a href="{{ route('admin.product.lowest', $brand_query) }}">Price Lowest</a></li>
                <li><a href="{{ route('admin.product.asc', $brand_query) }}">Product A-Z</a></li>
                <li><a href="{{ route('admin.product.desc', $brand_query) }}">Product Z-A</a></li>
                <li><a href="{{ route('admin.product.stock', $brand_query) }}">Stock</a></li>
            </ul>
        </div>
        <div class="dropdown pull-right">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Brands
            <span class="caret"></span></button>
            <ul class="dropdown-menu">
            @foreach ($brands as $brand)
                <li><a href="{{ route('admin.product.brand', $brand->id) }}">{{$brand->brand_name}}</a></li>
            @endforeach
            </ul>
        </div>
        <br>

        <h6>There are {{ $productCount }} products</h6><br>


        <table class="table table-bordered table-condensed table-hover">
            <thead>
            <tr>
                <th class="text-center blue white-text">Delete</th>
                <th class="text-center blue white-text">Edit</th>
                <th class="text-center blue white-text">Images</th>
                <th class="text-center blue white-text">Image</th>
                <th class="text-center blue white-text">Name</th>
                <th class="text-center blue white-text" id="td-display-mobile">Price</th>
                <th class="text-center blue white-text" id="td-display-mobile">Featured</th>
                <th class="text-center blue white-text" id="td-display-mobile">Weight</th>
                <th class="text-center blue white-text" id="td-display-mobile">Stock</th>
            </tr>
            </thead>
            <tbody>
            @foreach($product as $index=>$products)
            <tr>
                <td class="text-center">
                    <form method="post" action="{{ route('admin.product.delete', $products->id) }}" class="delete_form_product">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="DELETE">
                        <button id="delete-product-btn">
                            <i class="fa fa-trash red-text" aria-hidden="true"></i>
                        </button>
                    </form>
                </td>
                <td class="text-center">
                    <a href="{{ route('admin.product.edit', $products->id) }}">
                        <i class="fa fa-pencil green-text" aria-hidden="true"></i>
                    </a>
                </td>
                <td class="text-center">
                    <a href="{{ URL('/admin/products', $products->id) }}">
                        <i class="fa fa-camera"" aria-hidden="true"></i>
                    </a>
                </td>
                <td class="text-center" style="width: 10%;">
                    @if ($products->photos->count() === 0)
                        No Images
                    @else
                        @if ($products->featuredPhoto)
                            <img src="{{url('/')}}/{{ $products->featuredPhoto->thumbnail_path }}" alt="Photo ID: {{ $products->featuredPhoto->id }}" />
                        @elseif(!$products->featuredPhoto)
                            <img src="{{url('/')}}/{{ $products->photos->first()->thumbnail_path}}" alt="Photo" />
                        @else
                            N/A
                        @endif
                    @endif
                </td>
                <td class="text-center">{{ $products->product_name }}</td>
                <td class="text-center" id="td-display-mobile">
                    @if($products->reduced_price == 0)
                        {{ xformatMoney($products->price) }}
                    @else
                        <div class="text-danger list-price"><s>{{ xformatMoney($products->price) }}</s></div>
                        {{ xformatMoney($products->reduced_price) }}
                    @endif
                </td>
                <td class="text-center" id="td-display-mobile">
                    @if ($products->featured == 1)
                        Yes
                    @else
                        No
                    @endif
                </td>
                <td>{{ $products->weight }} gr</td>
                <td class="text-center">{{ $products->product_qty }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>

        {!! $product->links() !!}

    </div>

@endsection
@section('footer')
<script>
        $('#product-query').typeahead({
            minLength: 2,
            source: {
                data: [
                    @foreach($search as $query)
                         "{{ $query->product_name }}",
                    @endforeach
                ]
            }
        });
    </script>
@stop