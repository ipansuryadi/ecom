{!! Form::open(array('route' => 'admin.product.search')) !!}
{{csrf_field()}}
<div class="typeahead-container" id="typeahead-container">
	<div class="typeahead-field">
		<span class="typeahead-query" id="typeahead-query">
			{!! Form::text('search', null, array('style'=>'height:40px', 'id' => 'product-query', 'placeholder' => 'Search Product...', 'autocomplete' =>'off')) !!}
		</span>
		<button class="btn btn-secondary" id="Search-Btn" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
	</div>
</div>
{!! Form::close() !!}