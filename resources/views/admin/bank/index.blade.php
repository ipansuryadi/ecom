@extends('admin.dash')
@section('content')
<div class="container-fluid" id="admin-brand-container">
	<a href="#menu-toggle" class="btn btn-default visible-xs" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a>
	<div class="col-md-8" id="admin-brand-container">
	<a href="{{ route('admin.bank.create') }}" class="btn btn-primary">Add new Bank</a>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="text-center blue white-text col-md-1">Delete</th>
					<th class="text-center blue white-text col-md-1">Edit</th>
					<th class="text-center blue white-text">Bank Name</th>
					<th class="text-center blue white-text">Bank Account</th>
					<th class="text-center blue white-text" id="td-display-mobile">Bank Number</th>
				</tr>
			</thead>
			<tbody>
				@foreach($banks as $bank)
				<tr>
					<td class="text-center">
						<form method="post" action="{{ route('admin.bank.destroy', $bank->id) }}" class="delete_form_bank">
							{{ csrf_field() }}
							<input type="hidden" name="_method" value="DELETE">
							<button id="delete-bank-btn" style="border: none;">
							<i class="fa fa-trash red-text" aria-hidden="true"></i>
							</button>
						</form>
					</td><td class="text-center">
						<a href="{{ route('admin.bank.edit', $bank->id) }}">
							<i class="fa fa-pencil green-text" aria-hidden="true"></i>
						</a>
					</td>
					<td>{{ $bank->bank_name }}</td>
					<td>{{ $bank->account_name }}</td>
					<td id="td-display-mobile">{{ $bank->account_no }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	</div>  <!-- close container -->
@endsection