@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Quotation
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Quotation</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    Detail Quotation {{ $data->quotation_number }}
                </div>

                <div class="box-body">
                      <div class="form-group clearfix">
                        <div style="width: 200px; float: left;"><label for="exampleInputEmail1">Quotation number</label></div>
                        <div style="width: 10px; float: left;"> : </div>
                        <div>{{ $data->quotation_number }}</div>
                      </div>
                      <div class="form-group clearfix">
                        <div style="width: 200px; float: left;"><label for="exampleInputEmail1">Buyer</label></div>
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
                      <div class="form-group clearfix">
                        <div style="width: 200px; float: left;"><label for="exampleInputEmail1">Car</label></div>
                        <div style="width: 10px; float: left;"> : </div>
                        <div>{{ $data->product_name }}</div>
                      </div>
                      <div class="form-group clearfix">
                        <div style="width: 200px; float: left;"><label for="exampleInputEmail1">Amount</label></div>
                        <div style="width: 10px; float: left;"> : </div>
                        <div>$ {{ number_format($data->price, 2, '.', ',')  }}</div>
                      </div>
                      <div class="form-group clearfix">
                        <div style="width: 200px; float: left;"><label for="exampleInputEmail1">Shipping Cost</label></div>
                        <div style="width: 10px; float: left;"> : </div>
                        <div>$ {{ number_format($data->shipping_fee, 2, '.', ',')  }}</div>
                      </div>
                      <div class="form-group clearfix">
                        <div style="width: 200px; float: left;"><label for="exampleInputEmail1">IP Address</label></div>
                        <div style="width: 10px; float: left;"> : </div>
                        <div>{{ $data->ip_address }}</div>
                      </div>
                      <div class="form-group clearfix">
                        <div style="width: 200px; float: left;"><label for="exampleInputEmail1">Country</label></div>
                        <div style="width: 10px; float: left;"> : </div>
                        <div>{{ $data->country }}</div>
                      </div>
                      <div class="form-group clearfix">
                        <div style="width: 200px; float: left;"><label for="exampleInputEmail1">City</label></div>
                        <div style="width: 10px; float: left;"> : </div>
                        <div>{{ $data->city }}</div>
                      </div>
                      <br>
                      
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
