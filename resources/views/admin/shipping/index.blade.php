@extends('admin.dash')
@section('content')
<div class="container-fluid" id="admin-brand-container">
	<a href="#menu-toggle" class="btn btn-default visible-xs" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a>
	<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
		{!! Form::open(array('route' => 'admin.shipping.search')) !!}
		{{csrf_field()}}
		<div class="typeahead-container" id="typeahead-container">
			<div class="typeahead-field">
				<span class="typeahead-query" id="typeahead-query">
					{!! Form::text('search', null, array('style'=>'height:40px', 'id' => 'location-query', 'placeholder' => 'Search Location...', 'autocomplete' =>'off')) !!}
				</span>
				<button class="btn btn-secondary" id="Search-Btn" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
			</div>
		</div>
		{!! Form::close() !!}
	</div>
	<div class="col-md-8" id="admin-brand-container">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th class="text-center blue white-text col-md-1">Edit</th>
					<th class="text-center blue white-text">Location</th>
					<th class="text-center blue white-text" id="td-display-mobile">Cost / Kilo</th>
				</tr>
			</thead>
			<tbody>
				@foreach($shipping as $ship)
				<tr>
					<td class="text-center">
						<a href="{{ route('admin.shipping.edit', $ship->id) }}">
							<i class="fa fa-pencil green-text" aria-hidden="true"></i>
						</a>
					</td>
					<td>{{ $ship->location }}</td>
					<td id="td-display-mobile">
						{{ xformatMoney($ship->tarif) }}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		
		{!! $shipping->links() !!}
	</div>
	</div>  <!-- close container -->
	@endsection

@section('footer')
<script>
        $('#location-query').typeahead({
            minLength: 2,
            source: {
                data: [
                    @foreach($search as $query)
                         "{{ $query->location }}",
                    @endforeach
                ]
            }
        });
    </script>
@stop