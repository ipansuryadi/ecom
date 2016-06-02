@extends('admin.dash')
@section('content')
<div class="container">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<a href="{{url('/')}}/admin/slideshow/add" class="btn btn-primary">Add new Slideshow</a>
		<table class="table table-bordered table-condensed table-hover">
			<thead>
				<tr>
					<th class="text-center blue white-text col-md-1">Delete</th>
					<th class="text-center blue white-text col-md-1">Edit</th>
					<th class="text-center blue white-text">Images</th>
					<th class="text-center blue white-text">Link</th>
					<th class="text-center blue white-text">Sort</th>
					<th class="text-center blue white-text">Title</th>
					<th class="text-center blue white-text">Short Desc</th>
					
				</tr>
			</thead>
			<tbody>
				@foreach ($slideshows as $slideshow)
				<tr>
					<td class="col-md-1 text-center">
						<form method="post" action="{{url('/')}}/admin/slideshow/delete/{{ $slideshow->id }}" class="delete_form_slideshow">
							{{ csrf_field() }}
							<input type="hidden" name="_method" value="DELETE">
							<button id="delete-slideshow-btn" style="border: none;">
							<i class="fa fa-trash red-text" aria-hidden="true"></i>
							</button>
						</form>
					</td>
					<td class="col-md-1 text-center">
					<a href="{{ url('/') }}/admin/slideshow/edit/{{ $slideshow->id }}" title="">
						<i class="fa fa-pencil green-text" aria-hidden="true"></i>
					</a>
					</td>
					
					<td class="col-md-2">
						<!-- <img src="" class="img-responsive" alt="Image">
						<a href="{{ url('/') }}/src/public/Slideshows/{{ $slideshow->image_name }}" data-lity> -->
							<img src="{{ url('/') }}/src/public/Slideshows/{{ $slideshow->image_name }}"  data-id="{{ $slideshow->id }}" class="img-thumbnail">
						<!-- </a> -->
					</td>
					<td class="col-md-1 text-center"><a href="{{ $slideshow->link}}" title="">KLIK LINK</a></td>
					<td class="col-md-1 text-center">{{ $slideshow->order}}</td>
					<td class="col-md-2">{{ $slideshow->title}}</td>
					<td class="col-md-4">{{ $slideshow->short_desc}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<!-- </div> -->
</div>
@endsection
@section('footer')
@endsection