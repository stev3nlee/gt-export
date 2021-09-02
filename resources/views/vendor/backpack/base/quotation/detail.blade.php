@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Invoice Detail
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Invoice Detail</li>
      </ol>
    </section>
@endsection


@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>#{{ $data->invoice_number }}</small>
      </h1>
    </section>
    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <a href="{{ $previous_page }}">
            <i class="fa fa-arrow-left"></i>
            Back
          </a>
          
          <form role="form" class="pull-right" method="POST" action="{{ url(config('backpack.base.route_prefix', 'admin').'/invoice/id/' . $data->id . '/export/invoice') }}">
              @csrf
              <button type="submit" class="btn btn-success">Export Invoice</button>
          </form>
<!--           <form role="form" class="pull-right" method="POST" action="{{ url(config('backpack.base.route_prefix', 'admin').'/order/id/' . $data->id . '/export/shipping') }}" style="margin-right: 10px;">
              @csrf
              <button type="submit" class="btn btn-success">Export Packing List</button>
          </form> -->
        </div>
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> GT Export
            <small class="pull-right">Date: <?php echo date('m/d/Y', strtotime($data->created_at)) ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          <b>Consignee Address</b>
          <address>
             {{ $data->quotation->first_name }} {{ $data->quotation->last_name }}<br>
            {!! $data->consignee_address !!}<br><br>
            Contact No: {{ $data->quotation->phone_number }}<br>
            Email: {{ $data->quotation->email }}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice : {{ $data->invoice_number }}</b><br>
          <b>Order ID: {{ $data->id }}</b><br>
          <b>Remarks: {{ $data->remarks }}</b><br>
          <!-- <b>Tracking Number: {{ $data->tracking_number }}</b><br> -->
          <!-- <a href="https://tracker.janio.asia" target="_blank">(Click this link to track products)</a> -->
          <!-- <b>Payment Due:</b> 2/22/2014<br>
          <b>Account:</b> 968-34567 -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <table class="table table-striped table-bordered table-hover datatable" id="detail-table">
                                <thead>
                                    <tr class="nosortable">
                                        <th>Vehicle No</th>
                                        <th>Make & Model</th>
                                        <th>Colour</th>
                                        <th>ORD</th>
                                        <th>Engine Cap</th>
                                        <th>Mileage</th>
                                        <th>Chassis No</th>
                                        <th>Engine No</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                @foreach($data->invoice_details as $item)
                                <tr>
                                    <input type="hidden" name="detail[detail_id][]" value="{{ $item->id }}">
                                    <td><input type="text" disabled class="form-control vehicle_no" name="detail[vehicle_number][]" value="{{ $item->vehicle_number }}"></td>
                                    <td><input type="hidden" disabled class="form-control product_id" name="detail[product_id][]" value="{{ $item->product_id }}"><input type="text" disabled class="form-control make_model" name="detail[make_model][]" value="{{ $item->make_model }}"></td>
                                    <td><input type="text" disabled class="form-control colour" name="detail[colour][]" value="{{ $item->colour }}"></td>
                                    <td><input type="text" disabled class="form-control ord" name="detail[ord][]" value="{{ $item->ord }}"></td>
                                    <td><input type="text" disabled class="form-control engine_cap" name="detail[engine_cap][]" value="{{ $item->engine_cap }}"></td>
                                    <td><input type="text" disabled class="form-control mileage" name="detail[mileage][]" value="{{ $item->mileage }}"></td>
                                    <td><input type="text" disabled class="form-control chassis_no" name="detail[chassis_no][]" value="{{ $item->chassis_no }}"></td>
                                    <td><input type="text" disabled class="form-control engine_no" name="detail[engine_no][]" value="{{ $item->engine_no }}"></td>
                                    <td><input type="number" disabled step=0.01 class="form-control amount" name="detail[amount][]" value="{{ $item->amount }}"></td>
                                </tr>
                                @endforeach
                            </table>
      

      <div class="clearfix" style="padding: 10px; margin-top: 15px;">
        <div style="float: left;width: 70%;">&nbsp;</div>
        <div style="float: left;width: 15%;text-align: right; border-bottom: 1px solid #f5f5f5; padding-bottom: 10px;"><b>Subtotal</b></div>
        <div style="float: left;width: 15%; border-bottom: 1px solid #f5f5f5; padding: 0 0 10px;text-align: right;">{{ number_format($data->sub_total ,0,",",".") }}</div>
      </div>
      <div class="clearfix" style="padding: 10px;">
        <div style="float: left;width: 70%;">&nbsp;</div>
        <div style="float: left;width: 15%;text-align: right; border-bottom: 1px solid #f5f5f5; padding-bottom: 10px;"><b>Shipping</b></div>
        <div style="float: left;width: 15%; text-align: right; border-bottom: 1px solid #f5f5f5; padding: 0 0 10px;">{{ number_format($data->shipping_fee ,0,",",".") }}</div>
      </div>
      <div class="clearfix" style="padding: 10px; margin-bottom: 20px;">
        <div style="float: left;width: 70%;">&nbsp;</div>
        <div style="float: left;width: 15%;text-align: right;"><b>Grand Total</b></div>
        <div style="float: left;width: 15%;text-align: right;">{{ number_format($data->total_price ,0,",",".") }}</div>
      </div>


      <?php /* ?>
      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">
          <p class="lead">
            <b>Shipping Status</b>
          </p>

          <table class="table table-striped">
            <thead>
            <tr>
              <th>Shipping Status</th>
              <th>Date</th>
              <th>Description</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data->order_shipping_details as $lists)
            <tr>
              <td>
                @if ($lists->shipping_status == 'checkout')
                  Checkout
                @elseif ($lists->shipping_status == 'loading_goods')
                  Loading Goods
                @elseif ($lists->shipping_status == 'returned')
                  Returned
                @elseif ($lists->shipping_status == 'delivering')
                  Delivering
                @elseif ($lists->shipping_status == 'delivered')
                  Delivered
                @elseif ($lists->shipping_status == 'failed')
                  Failed
                @elseif ($lists->shipping_status == 'order_confirmed')
                  Order Confirmed
                @elseif ($lists->shipping_status == 'partners_sorting_centre')
                  Partners Sorting Centre
                @else
                  {{ $lists->shipping_status }}
                @endif
              </td>
              <td>{{ $lists->created_at }}</td>
              <td>{{ $lists->message }}</td>
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <p class="lead"><b>Billing Status</b></p>

          <table class="table table-striped">
            <thead>
            <tr>
              <th>Billing Status</th>
              <th>Date</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data->order_billing_details as $bill)
            <tr>
              <td>
                @if ($bill->billing_status == 'unpaid')
                  Abandoned Cart
                @elseif ($bill->billing_status == 'paid')
                  Paid
                @elseif ($bill->billing_status == 'failed')
                  Failed
                @elseif ($bill->billing_status == 'waiting_for_payment')
                  Waiting for payment
                @elseif ($bill->billing_status == 'cancel')
                  Cancelled
                @elseif ($bill->billing_status == 'expire')
                  Expired
                @elseif ($bill->billing_status == 'payment_confirmation')
                  Payment Confirmation
                @elseif ($bill->billing_status == 'pending')
                  Pending
                @elseif ($bill->billing_status == 'refund')
                  Refund
                @endif
              </td>
              <td>{{ $bill->created_at }}</td>
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <?php */ ?>

    </section>


@endsection
