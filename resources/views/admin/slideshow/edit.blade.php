@extends('admin.dash')

@section('content')

<div class="container" id="admin-product-container">
    <br><br>
    <a href="#menu-toggle" class="btn btn-default visible-xs" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a>
    <a href="#" onclick="window.history.back();return false;" class="btn btn-danger">Back</a>
    <br><br>
    <h4 class="text-center">Edit Slideshow</h4><br><br>
    <div class="col-md-12">
        <form role="form" method="POST" action="{{ url('/') }}/admin/slideshow/update/{{$slideshow->id}}">
        <input name="_method" type="hidden" value="PATCH">
            {{ csrf_field() }}
            <div class="col-sm-12 col-md-10" id="Product-Input-Field">
                <img class="img-responsive" id="blah" src="{{ url('/') }}/src/public/Slideshows/{{ Request::old('image_name') ? : $slideshow->image_name }}" style="max-height:200px;"/>
            </div>
            <div class="col-sm-6 col-md-4" id="Product-Input-Field">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" value="{{ Request::old('title') ? : $slideshow->title }}" placeholder="Add Title">
                    @if($errors->has('title'))
                    <span class="help-block">{{ $errors->first('title') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6 col-md-6" id="Product-Input-Field">
                <div class="form-group{{ $errors->has('short_desc') ? ' has-error' : '' }}">
                    <label>Short Description</label>
                    <input type="text" class="form-control" name="short_desc" value="{{ Request::old('short_desc') ? : $slideshow->short_desc }}" placeholder="Add Short Description">
                    @if($errors->has('short_desc'))
                    <span class="help-block">{{ $errors->first('short_desc') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6 col-md-6" id="Product-Input-Field">
                <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                    <label>Link</label>
                    <input type="text" class="form-control" name="link" value="{{ Request::old('link') ? : $slideshow->link }}" placeholder="Add Link">
                    @if($errors->has('link'))
                    <span class="help-block">{{ $errors->first('link') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-sm-6 col-md-4" id="Product-Input-Field">
                <div class="form-group{{ $errors->has('order') ? ' has-error' : '' }}">
                    <label>Order</label>
                    <input type="text" class="form-control" name="order" value="{{ Request::old('order') ? : $slideshow->order }}" placeholder="Order">
                    @if($errors->has('order'))
                    <span class="help-block">{{ $errors->first('order') }}</span>
                    @endif
                </div>
            </div>
            
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Update Slideshow</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('footer')

@endsection
