@extends('admin.dash')
@section('content')
<div class="container" id="admin-brand-container">
	<a href="#menu-toggle" class="btn btn-default visible-xs" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a>
	<a href="#" onclick="window.history.back();return false;" class="btn btn-danger">Back</a>
	<h4 class="text-center">Edit Shipping - {{ $shipping->location }}</h4><br><br>
	<div class="col-md-12" id="admin-brand-container">
		{!! Form::model($shipping, ['method' => 'PATCH', 'action' => ['ShippingController@update', $shipping->id]]) !!}
		{{ csrf_field() }}
		<div class="col-sm-8 col-md-6 col-md-offset-3 text-center">
			<div class="form-group{{ $errors->has('tarif') ? ' has-error' : '' }}">
				<input type="text" class="form-control" name="tarif" value="{{ Request::old('tarif') ? : $shipping->tarif }}" placeholder="Edit Brand">
				@if($errors->has('tarif'))
				<span class="help-block">{{ $errors->first('tarif') }}</span>
				@endif
			</div>
		</div>
		<div class="form-group col-sm-8 col-md-8 col-md-offset-2 text-center">
			<button type="submit" class="btn btn-primary waves-effect waves-light">Edit Price</button>
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection
@section('footer')
@stop