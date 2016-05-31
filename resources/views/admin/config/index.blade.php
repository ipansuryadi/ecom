@extends('admin.dash')
@section('content')
<div class="container" id="admin-product-container">
	<h4 class="text-center">Configuration</h4><br><br>
	<div class="col-md-12">
		<form role="form" method="POST" action="{{ route('admin.config.store') }}">
		{{ csrf_field()}}
			@foreach ($configs as $index=>$value)
				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
					<div class="form-group">
						<label class="active">{{$index}}</label>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<input type="text" class="form-control" name="{{$index}}" value="{{$value}}" placeholder="namename" required="required">
				</div>
			@endforeach
			
			<div class="form-group col-md-12">
				<button type="submit" class="btn btn-primary waves-effect waves-light">Submit</button>
			</div>
		</form>
	</div>
</div>
@endsection