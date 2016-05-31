@extends('app')
@section('content')
<div id="wrapper--">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
            @include('pages.partials.side-nav-two')
        </div>
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
    <!-- <a href="#menu-toggle" class="btn btn-default visible-xs" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a> -->
    <div class="container-fluid">
        <div class="col-md-6">
            <h4 class="text-center">{{config('label')->your_profile}}</h4><br>
            <a href="{{ url('profile/add') }}" class="btn btn-primary">{{config('label')->add_new_address}}</a>
            <div class="menu">
                <div class="accordion">
                    @if (count($address) == 0)
                    {{config('label')->you_have_no_address}}
                    @else
                    @foreach($address as $addr)
                    <div class="accordion-group">
                        <div class="accordion-heading" id="accordion-group">
                            <form action="{{url('profile/delete')}}" method="post" class="delete_form_address" accept-charset="utf-8">
                                {{ csrf_field() }}
                                <input type="hidden" name="address_id" value="{{$addr->id}}"></input>
                                <a class="accordion-toggle" data-toggle="collapse" href="#addr{{$addr->id}}">{{$addr->name}} - {{$addr->kecamatan}}</a>
                                <button class="pull-right" id="delete-address-btn" style="border: none; margin-top: -5px;">
                                <i class="fa fa-trash red-text fa-2x" aria-hidden="true"></i>
                                </button>
                            </form>
                            
                        </div>
                        <div id="addr{{$addr->id}}" class="accordion-body collapse">
                            <div class="accordion-inner">
                                <table class="table table-striped table-condensed">
                                    <tbody>
                                        <tr><th>{{config('label')->name}}</th><td>{{$addr->name}}</td></tr>
                                        <tr><th>{{config('label')->email}}</th><td>{{$addr->email}}</td></tr>
                                        <tr><th>{{config('label')->phone}}</th><td>{{$addr->phone}}</td></tr>
                                        <tr><th>Provinsi</th><td>{{$addr->provinsi}}</td></tr>
                                        <tr><th>Kabupaten / Kota</th><td>{{$addr->kabupaten}}</td></tr>
                                        <tr><th>Kecamatan</th><td>{{$addr->kecamatan}}</td></tr>
                                        <tr><th>{{config('label')->address}}</th><td>{{$addr->address}}</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
        </div>  <!-- close container-fluid -->
        </div>
        </div>  <!-- close wrapper -->
        @include('pages.partials.footer')
        @endsection