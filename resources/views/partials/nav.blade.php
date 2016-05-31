<!-- Navigation -->
<nav class="navbar" id="nav-bar-id">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ url('/') }}" id="nav-bar-logo"><img src="{{ url('/') }}/src/public/images/logo.png" alt=""></a>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                @include('pages.partials.search_box')
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        @if (!$signedIn)
                        <li><a href="{{ url('/register') }}" class="btn btn-secondary waves-effect waves-light">{{config('label')->register}}</a></li>
                        <li><a href="{{ url('/login') }}" class="btn-flat" id="nav-bar-Login">{{config('label')->signin}}</a></li>
                        @else
                        <li><a href="{{ route('cart') }}"><i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i><span class="badge green">{{ $cart_count }}</span>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-sm btn-secondary waves-effect waves-light" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                {{ $user->username }} <span class="caret"></span></a>
                                <ul class="dropdown-menu bounceInDown animated" id="dropdwon">
                                    @if ($user->admin=="1")
                                    {{-- expr --}}
                                    <li><a href="{{ url('admin/dashboard') }}">Admin Dashboard</a></li>
                                    @endif
                                    <li><a href="{{ url('/order') }}">{{config('label')->order}}</a></li>
                                    <li><a href="{{ url('/profile') }}">{{config('label')->profile}}</a></li>
                                    <li><a href="{{ url('/about') }}">{{config('label')->about_us}}</a></li>
                                    <li><a href="{{ url('/logout') }}">{{config('label')->logout}}</a></li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="text-center panel-heading">
                        @foreach($rand_brands as $rand)
                        <span id="random_brands"><a href="{{ url('brand', $rand->id) }}">{{ $rand->brand_name }}</a></span>
                        @endforeach
                    </div>
                </div> -->
            </div>
        </div>
    </nav>