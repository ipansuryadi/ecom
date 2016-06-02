@extends('admin.dash')
@section('content')
<div class="container-fluid" id="admin-brand-container">
	<a href="#menu-toggle" class="btn btn-default visible-xs" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a>
	<div class="col-md-8" id="admin-brand-container">
	<a href="{{ route('admin.static.create') }}" class="btn btn-primary">Add new Static Page</a>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="text-center blue white-text col-md-1">Delete</th>
					<th class="text-center blue white-text col-md-1">Edit</th>
					<th class="text-center blue white-text">Page Name</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($pages as $page)
				<tr>
					<td class="text-center">
						<form method="post" action="{{ route('admin.static.destroy', $page['filename']) }}" class="delete_form_page">
							{{ csrf_field() }}
							<input type="hidden" name="_method" value="DELETE">
							<button id="delete-page-btn" style="border: none;">
							<i class="fa fa-trash red-text" aria-hidden="true"></i>
							</button>
						</form>
					</td><td class="text-center">
						<a href="{{ route('admin.static.edit', $page['filename']) }}">
							<i class="fa fa-pencil green-text" aria-hidden="true"></i>
						</a>
					</td>
					<td>{{$page['filename']}}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	</div>  <!-- close container -->
@endsection