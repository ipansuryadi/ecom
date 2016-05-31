{!! Form::open(array('route' => 'queries.search')) !!}
{{csrf_field()}}
<div class="typeahead-container" id="typeahead-container">
	<div class="typeahead-field">
		<span class="typeahead-query" id="typeahead-query">
			{!! Form::text('search', null, array('id' => 'flyer-query', 'placeholder' => 'Search Products...', 'autocomplete' =>'off')) !!}
		</span>
			<button class="btn btn-secondary" id="Search-Btn" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
	</div>
</div>
{!! Form::close() !!}
