@extends('admin.dash')

@section('content')

    <div class="container-fluid" id="admin-brand-container">
        <a href="#menu-toggle" class="btn btn-default visible-xs" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a>
        <a href="{{ url('admin/brands/create') }}" class="btn btn-primary">Add new Brand</a>
        <br>

        <div class="col-md-9" id="admin-brand-container">

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center blue white-text col-md-1">Delete</th>
                    <th class="text-center blue white-text col-md-1">Edit</th>
                    <th class="text-center blue white-text col-md-1">View</th>
                    <th class="text-center blue white-text">Brands</th>
                    <th class="text-center blue white-text" id="td-display-mobile"># Products</th>
                </tr>
                </thead>
                <tbody>
                @foreach($brands as $brand)
                <tr>
                    <td class="text-center">
                        <form method="post" action="{{ route('admin.brand.delete', $brand->id) }}" class="delete_form_brand">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <button id="delete-btn-brand">
                                <i class="fa fa-trash red-text" aria-hidden="true"></i>
                            </button>
                        </form>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.brands.edit', $brand->id) }}">
                            <i class="fa fa-pencil green-text" aria-hidden="true"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('admin.brand.products', $brand->id) }}">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                    </td>
                    <td class="text-center">{{ $brand->brand_name }}</td>
                    <td class="text-center" id="td-display-mobile">
                        {{ $brand->productBrand->count() }}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    </div>  <!-- close container -->

@endsection
