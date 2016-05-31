@extends('app')
@section('content')
<div id="wrapper--">
    @include('pages.partials.carousel')
    @include('pages.partials.mobile-header')
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
            @include('pages.partials.side-nav-two')
        </div>
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
            @include('pages.partials.featured')
            @include('pages.partials.new')
            @include('pages.partials.mostview')
        </div>
    </div>
    
</div>
    @include('pages.partials.footer')
@stop