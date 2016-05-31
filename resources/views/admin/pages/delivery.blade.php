@extends('admin.dash')
@section('content')
<!-- Page Content -->
<div id="page-content-wrapper">
    <a href="#menu-toggle" class="btn btn-default visible-xs" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a>
    <div class="container-fluid" id="Admin_Dashboard_Container">
        <div class="row" id="Admin_Dashboard_Row">
            <div class="col-lg-12" id="Admin_Dashboard-col-md-12">
                <a href="#" onclick="window.history.back();return false;" class="btn btn-danger">Back</a>
                <h4 id="Admin-Heading">Admin Dashboard</h4><br>
                <div class="col-sm-12 col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        @foreach ($orders as $order)
                        {{-- expr --}}
                        <div class="panel-heading info-color-dark white-text"><i class="fa fa-shopping-cart" aria-hidden="true"></i> &nbsp;Order Delivery No : #{{$order->id}}</div>
                        <div class="panel-body">
                            <b>Shipping Address</b><br>
                            Name : {{ $order->address['name'] }}<br>
                            Email : {{ $order->address['email'] }}<br>
                            Phone : {{ $order->address['phone'] }}<br>
                            Provinsi : {{ $order->address['provinsi'] }}<br>
                            Kabupaten : {{ $order->address['kabupaten'] }}<br>
                            Kecamatan : {{ $order->address['kecamatan'] }}<br>
                            Address : {{ $order->address['address'] }}<br>
                            <div class="panel-body">
                                <form action="{{ url('admin/delivery') }}" class="delivery_form" method="POST" role="form">
                                    {{ csrf_field()}}
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                    <div class="form-group">
                                        <label for="">Courier</label>
                                        <input type="text" name="kurir" class="form-control" id="" placeholder="Input field">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Tracking Number</label>
                                        <input type="text" name="no_resi" class="form-control" id="" placeholder="Input field">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Delivery Cost</label>
                                        <input type="text" name="ongkir_real" class="form-control" id="" placeholder="Input field">
                                    </div>
                                    <button id="delivery-btn" class="btn btn-primary pull-right">Submit</button>
                                </form>
                            </div>
                            
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        </div>  <!-- close row -->
        </div>  <!-- close container-fluid -->
        </div>  <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
    @endsection