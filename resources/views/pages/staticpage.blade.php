@extends('app')
@section('content')
<div id="wrapper--">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
			@include('pages.partials.side-nav-two')
		</div>
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			
			
			<!-- Button to toggle side-nav -->
			<a href="#menu-toggle" class="btn btn-default visible-xs" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a>
			@include('pages.partials.staticpage')
		</div>
		</div>  <!-- close wrapper -->
		@include('pages.partials.footer')
		@stop