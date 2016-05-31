@extends('admin.dash')
@section('content')
<!-- Page Content -->
<div id="page-content-wrapper">
    <a href="#menu-toggle" class="btn btn-default visible-xs" id="menu-toggle"><i class="fa fa-bars fa-5x"></i></a>
    <div class="container-fluid" id="Admin_Dashboard_Container">
        <div class="row" id="Admin_Dashboard_Row">
            <div class="col-lg-12" id="Admin_Dashboard-col-md-12">
                <a href="#" onclick="window.history.back();return false;" class="btn btn-danger">Back</a>
                <h4 id="Admin-Heading">Admin Dashboard</h4><br>
                <div class="col-sm-12 col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                        <div class="panel-heading info-color-dark white-text"><i class="fa fa-shopping-cart" aria-hidden="true"></i> &nbsp;Payment Verification</div>
                        <div class="panel-body">
                            @foreach ($payment as $element)
                            <div class="panel-body">
                                <b>Order Detail</b> <br>
                                Order No : {{$element->order_id}}<br>
                                Date : {{prettyDate($element->order['created_at'])}}<br>
                                Total : {{$element->order['total']}}<br>
                            </div>
                            
                            <div class="panel-body">
                                <b>From</b> <br>
                                Bank Name : {{$element->bank_name}}<br>
                                Bank Account Name : {{$element->account_name}}<br>
                                Bank Account Number : {{$element->account_no}}<br>
                                Amount : {{$element->amount}}<br>
                            </div>
                            <div class="panel-body">
                                <b>To</b> <br>
                                Bank Name : {{$element->bank['bank_name']}}<br>
                                Bank Account Name : {{$element->bank['account_name']}}<br>
                                Bank Account Number : {{$element->bank['account_no']}}<br>
                            </div>
                            <form action="{{ url('admin/verify') }}" class="verify_form_payment" method="POST" role="form">
                                {{ csrf_field()}}
                                <input type="hidden" name="payment_id" value="{{$element->id}}">
                                <input type="hidden" name="order_id" value="{{$element->order_id}}">
                                <button id="verify-payment-btn" class="btn btn-primary">Verified</button>
                            </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>  <!-- close row -->
        </div>  <!-- close container-fluid -->
        </div>  <!-- /#page-content-wrapper -->
    </div>
    <!-- /#wrapper -->
    @endsection