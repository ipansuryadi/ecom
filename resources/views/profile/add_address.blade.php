@extends('app')
@section('content')

<div id="wrapper">
    @include('pages.partials.side-nav')
    <!-- Button to toggle side-nav -->
    <a href="#menu-toggle" class="btn btn-default visible-xs" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a>
    <div class="container-fluid">
        <div class="col-md-12">
            <a href="#" onclick="window.history.back();return false;" class="btn btn-danger">Back</a>
            <div class="row">
                <form action="{{url('profile/post')}}" method="POST" role="form">
                {{ csrf_field() }}
                    <legend class="text-center">{{config('label')->add_new_address}}</legend>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        
                        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="">{{config('label')->name}}</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="" placeholder="Input Name">
                            @if($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="">{{config('label')->email}}</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="" placeholder="Input Email">
                            @if($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="">{{config('label')->phone}}</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="" placeholder="Input Phone">
                            @if($errors->has('phone'))
                                <span class="help-block">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="">{{config('label')->address}}</label>
                            @if($errors->has('address'))
                                <span class="help-block">{{ $errors->first('address') }}</span>
                            @endif
                            <textarea name="address" id="input" class="form-control" rows="3">{{ old('address') }}</textarea>
                        </div>
                        
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group {{ $errors->has('provinsi') ? ' has-error' : '' }}">
                            <label for="">Provinsi</label>
                            <select name="provinsi"  id="loadProv" class="form-control">
                                <option value="" selected="" disabled="">Provinsi</option>

                                @foreach ($provinsi as $element)
                                {{-- expr --}}
                                <option value="{{$element->id}}">{{$element->provinsi_name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('provinsi'))
                                <span class="help-block">{{ $errors->first('provinsi') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('kabupaten') ? ' has-error' : '' }}">
                            <label for="">Kabupaten/Kota</label>
                            <select name="kabupaten" id="loadKab" class="form-control">
                                <option value="" selected="" disabled="">Kabupaten / Kota</option>
                            </select>
                            @if($errors->has('kabupaten'))
                                <span class="help-block">{{ $errors->first('kabupaten') }}</span>
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('kecamatan') ? ' has-error' : '' }}">
                            <label for="">Kecamatan</label>
                            <select name="kecamatan" id="loadKec" class="form-control">
                                <option value="" selected="" disabled="">Kecamatan</option>
                            </select>
                            @if($errors->has('kecamatan'))
                                <span class="help-block">{{ $errors->first('kecamatan') }}</span>
                            @endif
                        </div>
                        
                        <button type="submit" class="btn btn-primary pull-right">{{config('label')->submit}}</button>
                    </div>
                </form>
            </div>
        </div>
        </div>  <!-- close container-fluid -->
        </div>  <!-- close wrapper -->
        @endsection