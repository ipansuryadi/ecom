@if ($cart_total === 0)

@else
    @if (count($address) == 0)
        <a href="{{ url('profile') }}" class="list-group-item list-group-item-danger">{{config('label')->you_dont_have_any_address}}. {{config('label')->please_make_new_address_from_profile_menu}}.</a>
    @else
        {{-- false expr --}}
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default" id="Checkout-Shipping-Payment-Container">
                    <div class="panel-heading">{{config('label')->select_shipping_information}}</div>
                    <div class="panel-body">
                        <form id="payment-form" role="form" method="POST" action="{{url('/')}}/order">
                            {!! csrf_field() !!}
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>{{config('label')->select}}</th>
                                        <th>{{config('label')->name}}</th>
                                        <th>{{config('label')->phone}}</th>
                                        <th>{{config('label')->email}}</th>
                                        <th>{{config('label')->full_address}}</th>
                                        <th>{{config('label')->cost}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($address as $index=>$addr)
                                    <?php
                                        switch ($weight_total) {
                                            case $weight_total > 10000:
                                                $total_weight = 11;
                                                break;
                                            case $weight_total > 9000:
                                                $total_weight = 10;
                                                break;
                                            case $weight_total > 8000:
                                                $total_weight = 9;
                                                break;
                                            case $weight_total > 7000:
                                                $total_weight = 8;
                                                break;
                                            case $weight_total > 6000:
                                                $total_weight = 7;
                                                break;
                                            case $weight_total > 5000:
                                                $total_weight = 6;
                                                break;
                                            case $weight_total > 4000:
                                                $total_weight = 5;
                                                break;
                                            case $weight_total > 3000:
                                                $total_weight = 4;
                                                break;
                                            case $weight_total > 2000:
                                                $total_weight = 3;
                                                break;
                                            case $weight_total > 1000:
                                                $total_weight = 2;
                                                break;
                                            default:
                                                $total_weight = 1;
                                                break;
                                            }
                                    ?>
                                    <tr>
                                        <td><input type="radio" {{($index==0)?'checked':''}} name="address_id" value="{{$addr->id}}|{{$total_weight*$addr->tarif}}"></td>
                                        <td>{{$addr->name}}</td>
                                        <td>{{$addr->phone}}</td>
                                        <td>{{$addr->email}}</td>
                                        <td>{{$addr->address}}</td>
                                        
                                        <td><b>{{xformatMoney($total_weight*$addr->tarif)}}</b></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="col-md-12">
                                <br><br>
                                <div class="form-group">
                                <input type="hidden" id="refresh" value="no">
                                    <button type="submit" class="btn btn-default waves-effect waves-light pull-right">
                                        {{config('label')->confirm}}
                                    </button>
                                </div>
                            </div>
                        </form> <!-- close form -->

                    </div>  <!-- close panel-body -->
                </div>  <!-- close panel-default -->
            </div>  <!-- close col-md-10 -->
        </div>  <!-- row -->
    @endif
@endif
@section('footer')
@stop