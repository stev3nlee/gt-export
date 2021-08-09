@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Order Detail
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Order Detail</li>
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
          
          <form role="form" class="pull-right" method="POST" action="{{ url(config('backpack.base.route_prefix', 'admin').'/order/id/' . $data->id . '/export/billing') }}">
              @csrf
              <button type="submit" class="btn btn-success">Export Invoice</button>
          </form>
          <a style="float: right;" class="btn btn-danger" onclick="return confirm('Are you want to refund this order?');" href="{{ url(config('backpack.base.route_prefix', 'admin').'/order/refund/'.$data->id) }}">
            Refund
          </a>
<!--           <form role="form" class="pull-right" method="POST" action="{{ url(config('backpack.base.route_prefix', 'admin').'/order/id/' . $data->id . '/export/shipping') }}" style="margin-right: 10px;">
              @csrf
              <button type="submit" class="btn btn-success">Export Packing List</button>
          </form> -->
        </div>
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> YUM Organic Farm
            <small class="pull-right">Date: <?php echo date('m/d/Y', strtotime($data->created_at)) ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <!-- <div class="col-sm-4 invoice-col">
          <b>Billing Address</b>
          <address>
            {{ $data->order_billing_address->first_name }} {{ $data->order_billing_address->last_name }}<br>
            {!! $data->order_billing_address->address !!}<br>
            {{ $data->order_billing_address->district }}, {{ $data->order_billing_address->city }}, {{ $data->order_billing_address->province }} {{ $data->order_billing_address->postal_code }} <br>
            Phone: {{ $data->order_billing_address->phone_number }}<br>
            Email: {{ $data->order_billing_address->email }}
          </address>
        </div> -->
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Shipping Address</b>
          <address>
             {{ $data->order_shipping_address->first_name }} {{ $data->order_shipping_address->last_name }}<br>
            {!! $data->order_shipping_address->address !!}<br>
            {{ $data->order_shipping_address->district }}, {{ $data->order_shipping_address->city }}, {{ $data->order_shipping_address->province }} {{ $data->order_shipping_address->postal_code }} <br>
            Phone: {{ $data->order_shipping_address->phone_number }}<br>
            Email: {{ $data->order_shipping_address->email }}
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>Invoice : {{ $data->invoice_number }}</b><br>
          <b>Order ID: {{ $data->id }}</b><br>
          <!-- <b>Tracking Number: {{ $data->tracking_number }}</b><br> -->
          <!-- <a href="https://tracker.janio.asia" target="_blank">(Click this link to track products)</a> -->
          <!-- <b>Payment Due:</b> 2/22/2014<br>
          <b>Account:</b> 968-34567 -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="clearfix" style="background: #f5f5f5;padding: 10px;">
        <div style="float: left; width: 5%;"><b>Qty</b></div>
        <div style="float: left; width: 50%;"><b>Product</b></div>
        <div style="float: left; width: 22%;text-align: right;"><b>Price (IDR)</b></div>
        <!-- <div style="float: left; width: 15%;text-align: right;"><b>Discount (IDR)</b></div> -->
        <div style="float: left; width: 22%;text-align: right;"><b>Total (IDR)</b></div>
      </div>
      <?php $total_original = 0; $total_disc = 0; $currency_rate = $data->currency_rate ? $data->currency_rate : 1; ?>
      @foreach($data->order_details as $list)
      <div class="clearfix" style="padding: 10px;">
        <div style="float: left; width: 5%;">{{ $list->product_quantity }}</div>
        <div style="float: left; width: 50%;">{{ $list->product_name }}</div>
        <div style="float: left; width: 22%; text-align: right;">{{ number_format($list->product_price ,0,",",".") }}</div>
        <?php $disc_price = $list->product_original_price - $list->product_price; ?>
        <!-- <div style="float: left; width: 15%; text-align: right;">{{ number_format($disc_price * $list->product_quantity ,0,",",".") }}</div> -->
        <div style="float: left; width: 22%; text-align: right;">{{ number_format($list->product_price * $list->product_quantity ,0,",",".") }}</div>
      </div>
      <?php $total_original += round($list->product_original_price * $list->product_quantity,2); 
            $total_disc += round($disc_price * $list->product_quantity,2); 
       ?>
      @endforeach

      <div class="clearfix" style="padding: 10px; margin-top: 15px;">
        <div style="float: left;width: 70%;">&nbsp;</div>
        <div style="float: left;width: 15%;text-align: right; border-bottom: 1px solid #f5f5f5; padding-bottom: 10px;"><b>Subtotal</b></div>
        <!-- <div style="float: left;width: 15%; border-bottom: 1px solid #f5f5f5; padding: 0 0 10px;text-align: right;"> {{ number_format($data->sub_total ,0,",",".") }}</div> -->
        <?php /* ?><div style="float: left;width: 15%; border-bottom: 1px solid #f5f5f5; padding: 0 0 10px;text-align: right;">{{ number_format($total_disc ,0,",",".") }}</div><?php */ ?>
        <div style="float: left;width: 15%; border-bottom: 1px solid #f5f5f5; padding: 0 0 10px;text-align: right;">{{ number_format($data->sub_total ,0,",",".") }}</div>
      </div>
<!--       <div class="clearfix" style="padding: 10px;">
        <div style="float: left;width: 70%;">&nbsp;</div>
        <div style="float: left;width: 15%; text-align: right;border-bottom: 1px solid #f5f5f5; padding-bottom: 10px;"><b>Coupon</b></div>
        <div style="float: left;width: 15%; border-bottom: 1px solid #f5f5f5; padding: 0 0 10px; text-align: right;">@if($data->promo_code) {{ number_format($data->discount_price ,0,",",".") }} @else None @endif</div>
      </div> -->

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


    </section>


@endsection
