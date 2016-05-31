@extends('app')
@section('content')
<div id="wrapper--">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
            @include('pages.partials.side-nav-two')
        </div>
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
            <div class="container-fluid">
                <div class="col-md-12">
                    <h4 class="text-center">{{config('label')->confirm_payment}}</h4>
                    <div class="col-sm-12 col-md-8 col-md-offset-2">
                        @foreach($orders as $order)
                        <div class="panel panel-default">
                            <div class="panel-heading warning-color white-text">Order No : {{$order->id}} - {{prettyDate($order->created_at)}}</div>
                            <div class="panel-body">
                                <table class="table table-striped table-condensed">
                                    <thead>
                                        <tr>
                                            <th>
                                                {{config('label')->products}}
                                            </th>
                                            <th>
                                                {{config('label')->quantity}}
                                            </th>
                                            <th>
                                                {{config('label')->product_price}}
                                            </th>
                                            <th>
                                                {{config('label')->total}}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderItems as $orderitem)
                                        <tr>
                                            <td><a href="{{ route('show.product', $orderitem->product_name) }}">{{$orderitem->product_name}}</a></td>
                                            <td>{{$orderitem->pivot->qty}}</td>
                                            <td>
                                                @if($orderitem->pivot->reduced_price == 0)
                                                {{ xformatMoney($orderitem->pivot->price) }}
                                                @else
                                                {{ xformatMoney($orderitem->pivot->reduced_price) }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($orderitem->pivot->total_reduced == 0)
                                                {{xformatMoney($orderitem->pivot->total)}}
                                                @else
                                                {{xformatMoney($orderitem->pivot->total_reduced)}}
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3">{{config('label')->shipping_cost}}</td>
                                            <td>{{xformatMoney($order->total_ongkir)}}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr><th colspan="3">Total</th><th>{{xformatMoney($order->total)}}</th></tr>
                                    </tfoot>
                                </table>
                                <div class="panel panel-default">
                                    <div class="panel-heading">{{config('label')->shipping_information}}</div>
                                    <div class="panel-body">
                                        <div class="col-md-3">{{config('label')->name}}:</div><div class="col-md-9"> {{$order->address->name}}</div>
                                        <div class="col-md-3">{{config('label')->email}}:</div><div class="col-md-9"> {{$order->address->email}}</div>
                                        <div class="col-md-3">{{config('label')->phone}}:</div><div class="col-md-9"> {{$order->address->phone}}</div>
                                        <div class="col-md-3">Provinsi:</div><div class="col-md-9"> {{$order->address->provinsi}}</div>
                                        <div class="col-md-3">Kabupaten / Kota:</div><div class="col-md-9"> {{$order->address->kabupaten}}</div>
                                        <div class="col-md-3">Kecamatan:</div><div class="col-md-9"> {{$order->address->kecamatan}}</div>
                                        <div class="col-md-3">{{config('label')->address}}:</div><div class="col-md-9"> {{$order->address->address}}</div>
                                    </div>
                                </div>
                                @if ($order->status == "unpaid")
                                    {{-- expr --}}
                               
                                <form action="{{ url('order/confirmation') }}" method="POST" role="form">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                    <legend>{{config('label')->form_confirmation}}</legend>
                                    
                                    <div class="form-group">
                                        <label for="">{{config('label')->bank_name}}</label>
                                        <input type="text" name="bank_name" class="form-control" id="" placeholder="Input field">
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{config('label')->bank_account_name}}</label>
                                        <input type="text" name="account_name" class="form-control" id="" placeholder="Input field">
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{config('label')->bank_account_number}}</label>
                                        <input type="text" name="account_no" class="form-control" id="" placeholder="Input field">
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{config('label')->select_bank}}</label>
                                        <select name="bank_id" id="input" class="form-control" required="required">
                                            @foreach ($banks as $element)
                                            <option value="{{$element->id}}">{{$element->bank_name}}, {{$element->account_name}}, {{$element->account_no}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">{{config('label')->amount}} : {{xformatMoney($order->total)}}</label>
                                        <input id="currency" type="text" name="amount" class="form-control" placeholder="Input payment">
                                    </div>
                                    <input type="hidden" id="refresh" value="no">
                                    <button type="submit" class="btn btn-primary pull-right">{{config('label')->submit}}</button>
                                </form>
                                 @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @section('header')
    <link rel="stylesheet" href="{{ url('/') }}/src/public/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
    @endsection
    @section('footer')
    <script type="text/javascript">
        $(document).ready(function(e) {
            var $input = $('#refresh');
            $input.val() == 'yes' ? location.reload(true) : $input.val('yes');
        });
    </script>
    <script type="text/javascript" src="{{ url('/') }}/src/public/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript">
    var format = function(num){
    var str = num.toString().replace("$", ""), parts = false, output = [], i = 1, formatted = null;
    if(str.indexOf(".") > 0) {
    parts = str.split(".");
    str = parts[0];
    }
    str = str.split("").reverse();
    for(var j = 0, len = str.length; j < len; j++) {
    if(str[j] != ",") {
    output.push(str[j]);
    if(i%3 == 0 && j < (len - 1)) {
    output.push(",");
    }
    i++;
    }
    }
    formatted = output.reverse().join("");
    return(formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
    };
    $(function(){
    $("#currency").keyup(function(e){
    $(this).val(format($(this).val()));
    });
    });
    </script>
    <script type="text/javascript">
    $(function () {
    $('#tanggal_pembayaran').datetimepicker(
    {
    locale: 'id',
    format: 'dddd, DD/MM/YYYY'
    });
    });
    </script>
     @include('pages.partials.footer')
    @endsection