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

                <div class="box-body">
                    @include('vendor.backpack.base.inc.alert')
                    <div class="row">
                        <div class="col-md-10 text-right">
                            <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix', 'admin').'/quotation/exportToExcel') }}">
                                <!-- <a style="float: left;" href="{{ url(config('backpack.base.route_prefix', 'admin').'/quotation/create') }}" class="btn btn-success">Create Quotation</a> -->
                                @csrf
                                <div style="display: inline-block;vertical-align: middle;">
                                    <div class="form-group" style="margin-bottom: 0;">
                                        <label style="display: inline-block; vertical-align: middle; margin-bottom: 0; margin-right: 10px;">Start From:</label>
                                        <div style="display: inline-block; width: 150px; vertical-align: middle;">
                                            <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                                <input type="text" class="form-control pull-right datepicker" id="start_date" name="start_date" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: inline-block;vertical-align: middle; margin: 0 15px;">
                                    <div class="form-group" style="margin-bottom: 0;">
                                        <label style="display: inline-block; vertical-align: middle; margin-bottom: 0; margin-right: 10px;">To:</label>
                                        <div style="display: inline-block; width: 150px; vertical-align: middle;">
                                            <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                                <input type="text" class="form-control pull-right datepicker" id="end_date" name="end_date" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <input type="hidden" name="shipping_type_export" value="{{ request('shipping_type') }}"> -->
                                <input type="hidden" name="quotation_status_export" value="{{ request('quotation_status') }}">
                                <!-- <input type="hidden" name="payment_type_export" value="{{ request('payment_type') }}"> -->
                                <div style="display: inline-block;vertical-align: middle;">
                                    <button type="submit" class="btn btn-success">Export Quotation Report</button>
                                </div>
                            </form>
                        </div>
                        <br><br>
                        <div class="col-md-12">
                            <form action="{{ url()->current() }}" class="pull-right" style="width: 100%;">
                                <div class="row">
                                    
                                    <!-- <div class="col-md-3">
                                        <select class="form-control" name="print_status" id="print_status" onChange="this.form.submit()">
                                            <option value="">Select Print Status</option>
                                            <option value="">All</option>
                                            <option value="1" {{ request('print_status') == '1' ? 'selected' : '' }}>Printed</option>
                                            <option value="2" {{ request('print_status') == '2' ? 'selected' : '' }}>Not Printed</option>
                                        </select>
                                    </div> -->
                                    <div class="col-md-3">
                                        <select class="form-control" name="quotation_status" id="quotation_status" onChange="this.form.submit()">
                                            <option value="">Select Quotation Status</option>
                                            <option value="1" {{ request('quotation_status') == '1' ? 'selected' : '' }}>Pending</option>
                                            <option value="2" {{ request('quotation_status') == '2' ? 'selected' : '' }}>Fulfilled</option>
                                            <option value="3" {{ request('quotation_status') == '3' ? 'selected' : '' }}>Unsuccessful</option>
                                        </select>
                                    </div> 
                                    <!-- <div class="col-md-3">
                                        <select class="form-control" name="shipping_type" id="shipping_type" onChange="this.form.submit()">
                                            <option value="">Select Shipping Type</option>
                                            <option value="delivery" {{ request('shipping_type') == 'delivery' ? 'selected' : '' }}>Delivery</option>
                                            <option value="pick_up" {{ request('shipping_type') == 'pick_up' ? 'selected' : '' }}>Pick Up</option>
                                        </select>
                                    </div>  -->
                                   <!--  <div class="col-md-3">
                                        <select class="form-control" name="payment_type" id="payment_type" onChange="this.form.submit()">
                                            <option value="">Select Payment Type</option>
                                            <option value="credit_card" {{ request('payment_type') == 'credit_card' ? 'selected' : '' }}>Credit Card</option>
                                            <option value="gopay" {{ request('payment_type') == 'gopay' ? 'selected' : '' }}>Gopay</option>
                                            <option value="bank_transfer" {{ request('payment_type') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                            <option value="bca_klikpay" {{ request('payment_type') == 'bca_klikpay' ? 'selected' : '' }}>BCA Klikpay</option>
                                            <option value="bca_klikbca" {{ request('payment_type') == 'bca_klikbca' ? 'selected' : '' }}>Klik Bca</option>
                                            <option value="mandiri_clickpay" {{ request('payment_type') == 'mandiri_clickpay' ? 'selected' : '' }}>Mandiri Klikpay</option>
                                            <option value="cimb_clicks" {{ request('payment_type') == 'cimb_clicks' ? 'selected' : '' }}>CIMB Click</option>
                                            <option value="danamon_online" {{ request('payment_type') == 'danamon_online' ? 'selected' : '' }}>Danamon Online</option>
                                            <option value="bri_epay"{{ request('payment_type') == 'bri_epay' ? 'selected' : '' }}>Bri Epay</option>
                                            <option value="paypal"{{ request('payment_type') == 'paypal' ? 'selected' : '' }}>Paypal</option>
                                        </select>
                                    </div>  -->
                                    <!-- <br> -->
                                    <div class="col-md-3" style="float: right;">
                                        <input type="text" name="keyword" class="form-control" placeholder="Search Quotation Number or Email" value="{{ request('keyword') }}">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="dataTable_wrapper table-responsive">
                        <table class="table table-striped table-bquotationed table-hover datatable ">
                            <thead>
                                <tr class="nosortable">
                                    <th>Quotation</th>
                                    <th>Buyer</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Car</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th class="table-actions">Action</th>

                                    <!-- <th>Request New Pickup</th> -->
                                </tr>
                            </thead>
                            <tbody id="element-quotation">
                              @foreach ($data as $content)
                                    <tr>
                                        <td>{{ $content->quotation_number }}</td>
                                        <td>{{ ucwords(strtolower($content->first_name)) . ' ' . ucwords(strtolower($content->last_name)) }}</td>
                                        <td>{{ strtolower($content->email) }}</td>
                                        <td>{{ $content->phone }}</td>
                                        <td>{{ $content->product->name }}</td>
                                        <td>$ {{ number_format($content->price, 2, '.', ',')  }}</td>
                                        <td>@if($content->status == 1)
                                                <span class="badge bg-blue">Pending</span>
                                            @elseif($content->status == 2)
                                                <span class="badge bg-green">Fulfilled</span>
                                            @elseif($content->status == 3)
                                                <span class="badge bg-red">Unsuccessful</span>
                                            @endif
                                        </td>
                                        
                                        
                                        <td>
                                        <div class="table-actions-hover">
                                                <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/quotation/detail/'.$content->id) }}"><i class="fa fa-eye fa-fw"></i></a>
                                                
                                                <!-- <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/quotation/edit/'.$content->id) }}"><i class="fa fa-pencil fa-fw"></i></a> -->
                                                
                                                 <!-- |
                                                <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/quotation_packing/id/' . $content->id . '/export/shipping') }}">Packing</a> -->
                                            </div>
                                        </td>
                                    </tr>
                              @endforeach
                            </tbody>
                        </table>
                        {{ $data->links("pagination::bootstrap-4") }}
                    </div>
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
    </div>

    
@endsection
@section('after_scripts')
  <script>
  $('#select-all').click(function(event) {   
        if(this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function() {
                this.checked = true;                        
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;                       
            });
        }
    });
  </script>
@endsection
