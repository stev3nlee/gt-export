@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Member
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Member</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    Detail Member
                </div>

                <div class="box-body">
                      <div class="form-group clearfix">
                        <div style="width: 200px; float: left;"><label for="exampleInputEmail1">Full Name</label></div>
                        <div style="width: 10px; float: left;"> : </div>
                        <div>{{ $data->first_name }} {{ $data->last_name }}</div>
                      </div>
                      <div class="form-group clearfix">
                        <div style="width: 200px; float: left;"><label for="exampleInputEmail1">Email</label></div>
                        <div style="width: 10px; float: left;"> : </div>
                        <div>{{ $data->email }}</div>
                      </div>
                      <div class="form-group clearfix">
                        <div style="width: 200px; float: left;"><label for="exampleInputEmail1">Phone Number</label></div>
                        <div style="width: 10px; float: left;"> : </div>
                        <div>{{ $data->phone }}</div>
                      </div>
                      <div class="form-group clearfix">
                        <div style="width: 200px; float: left;"><label for="exampleInputEmail1">Date of Birth</label></div>
                        <div style="width: 10px; float: left;"> : </div>
                        <div>@if($data->dob){{ date('d F Y',strtotime($data->dob)) }}@endif</div>
                      </div>

                      <!-- <div class="form-group clearfix">
                        <div style="width: 200px; float: left;"><label for="exampleInputEmail1">Gender</label></div>
                        <div style="width: 10px; float: left;"> : </div>
                        <div>{{ $data->gender }}</div>
                      </div> -->
                      
                      <br>
                      <?php /* ?>
                    <div class="col-sm-4 ">
                      <strong>Billing Address</strong>
                      @if($data->billing_address)
                      <address>
                        {{ $data->billing_address->first_name }} {{ $data->billing_address->last_name }}<br>
                        {{ $data->billing_address->address }}, {{ $data->billing_address->country }}<br> {{ $data->billing_address->zip_code }}<br>
                        Phone: {{ $data->billing_address->phone_number }}<br>
                        Email: {{ $data->billing_address->email }}
                      </address>
                      @endif
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                      <strong>Shipping Address</strong>
                      @if($data->shipping_address)
                      <address>
                         {{ $data->shipping_address->first_name }} {{ $data->shipping_address->last_name }}<br>
                        {{ $data->shipping_address->address }}, {{ $data->shipping_address->country }}<br> {{ $data->shipping_address->zip_code }}<br>
                        Phone: {{ $data->shipping_address->phone_number }}<br>
                        Email: {{ $data->shipping_address->email }}
                      </address>
                      @endif
                    </div>
                    <?php */ ?>
                </div>
            </div>
        </div>
    </div>
@endsection
