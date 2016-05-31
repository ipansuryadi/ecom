@if ($cart_total === 0)

@else
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default" id="Checkout-Shipping-Payment-Container">
                <div class="panel-heading">{{config('label')->shipping_information}}</div>
                <div class="panel-body">

                    <form id="payment-form" role="form" method="POST" action="{{url('/')}}/order">
                        {!! csrf_field() !!}

                        <div class="alert alert-danger payment-errors @if(!$errors->any()){{'hidden'}}@endif">
                            {{$errors->first('error')}}
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label>{{config('label')->first_name}}</label>
                                <input type="text" title="first_name" class="form-control" name="first_name" value="{{ old('first_name') }}">
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                                    <strong>{{ $errors->first('first_name') }}</strong>
                                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label>{{config('label')->last_name}}</label>
                                <input type="text" title="last_name" class="form-control" name="last_name" value="{{ old('last_name') }}">
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                                    <strong>{{ $errors->first('last_name') }}</strong>
                                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label>{{config('label')->address}}</label>
                                <input type="text" title="address" class="form-control" name="address" value="{{ old('address') }}">
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label>City</label>
                                <input type="text" title="city" class="form-control" name="city" value="{{ old('city') }}">
                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="state">State:</label>
                                <select id="state" name="state" class="form-control">
                                    @foreach(App\Http\Utilities\States::all() as $state)
                                        <option value="{{ $state }}" >{{ $state }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-6" style="padding-left: 0;">
                                <div class="form-group{{ $errors->has('zip') ? ' has-error' : '' }}">
                                    <label>Zip Code</label>
                                    <input type="text" title="zip" class="form-control" name="zip" value="{{ old('zip') }}">
                                    @if ($errors->has('zip'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('zip') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <br><br><br>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
                                <label>Name On Card</label>
                                <input type="text" class="form-control" size="20" name="full_name" value="{{ old('full_name') }}">
                                @if ($errors->has('full_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('full_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        


                        <div class="col-md-12">
                            <br><br>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default waves-effect waves-light">
                                    CONFIRM PAYMENT
                                </button>
                            </div>
                        </div>

                    </form> <!-- close form -->

                </div>  <!-- close panel-body -->
            </div>  <!-- close panel-default -->
        </div>  <!-- close col-md-10 -->
    </div>  <!-- row -->
@endif

<br><br><br><br> <br><br><br><br>