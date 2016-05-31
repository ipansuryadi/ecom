@extends('admin.dash')
@section('content')
<!-- Page Content -->
<div id="page-content-wrapper">
    <a href="#menu-toggle" class="btn btn-default visible-xs" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a>
    <div class="container-fluid" id="Admin_Dashboard_Container">
        <div class="row" id="Admin_Dashboard_Row">
            <div class="col-lg-12" id="Admin_Dashboard-col-md-12">
                <div class="col-sm-12 col-md-12">
                    @include('admin.pages.partials.orders')
                </div>
            </div>
        </div>
    </div>
</div>
        <!-- /#wrapper -->
        @endsection