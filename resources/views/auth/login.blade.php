@extends('app')

@section('content')

    <div class="container-fluid" id="Login-Register-Container">
        <div class="row-">
            <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                <div class="panel panel-default" id="Login-Register-Panel">
                    <div class="panel-body">
                        <h4 class="text-center" id="log-in">{{config('label')->login}}</h4>
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('auth.login') }}">
                            {!! csrf_field() !!}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <div class="col-md-10 col-md-offset-1">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="email">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <div class="col-md-10 col-md-offset-1">
                                    <input type="password" class="form-control" name="password" placeholder="password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-10 col-md-offset-1">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> {{config('label')->remember_me}}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3 text-center">
                                    <button type="submit" class="btn btn-default btn-rounded waves-effect waves-light btn-block">{{config('label')->login}}</button>
                                </div>
                                <div class="col-md-12">
                                <a href="{{ url('password/email') }}" class="center-block text-center" id="Forgot-Password">{{config('label')->forgot_password}}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <p id="No-Account" class="center-block text-center">{{config('label')->dont_have_an_account}}? <a href="{{ url('/register') }}" id="Sign-up">{{config('label')->register}}</a></p>                
            </div>
        </div>
    </div>
@endsection
