@extends('admin.dash')
@section('content')
<div class="container" id="admin-brand-container">
	<a href="#menu-toggle" class="btn btn-default visible-xs" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a>
	<a href="#" onclick="window.history.back();return false;" class="btn btn-danger">Back</a>
	<h4 class="text-center">Add new Bank</h4><br><br>
	<div class="col-md-12" id="admin-brand-container">
		<form role="form" method="POST" action="{{ url('admin/bank') }}">
			{{ csrf_field() }}
			<div class="col-sm-8 col-md-8 col-md-offset-2">
				<div class="form-group{{ $errors->has('bank_name') ? ' has-error' : '' }}">
					<label>Bank Name</label>
					<input type="text" class="form-control" name="bank_name" value="{{ old('bank_name') }}" placeholder="Bank Name">
					@if($errors->has('bank_name'))
					<span class="help-block">{{ $errors->first('bank_name') }}</span>
					@endif
				</div>
			</div>
			<div class="col-sm-8 col-md-8 col-md-offset-2">
				<div class="form-group{{ $errors->has('account_name') ? ' has-error' : '' }}">
					<label>Bank Account Name</label>
					<input type="text" class="form-control" name="account_name" value="{{ old('account_name') }}" placeholder="Bank Account Name">
					@if($errors->has('account_name'))
					<span class="help-block">{{ $errors->first('account_name') }}</span>
					@endif
				</div>
			</div>
			<div class="col-sm-8 col-md-8 col-md-offset-2">
				<div class="form-group{{ $errors->has('account_no') ? ' has-error' : '' }}">
					<label>Bank Account Number</label>
					<input type="text" class="form-control" name="account_no" value="{{ old('account_no') }}" placeholder="Bank Account Number">
					@if($errors->has('account_no'))
					<span class="help-block">{{ $errors->first('account_no') }}</span>
					@endif
				</div>
			</div>
			<div class="form-group col-sm-8 col-md-8 col-md-offset-2 text-right">
				<button type="submit" class="btn btn-primary waves-effect waves-light">Create Brand</button>
			</div>
		</form>
	</div>
</div>
@endsection