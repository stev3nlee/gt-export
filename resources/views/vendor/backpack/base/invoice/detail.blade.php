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
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/front.css') }}" rel="stylesheet"/>
    <style>
      body {
        padding-top: 0;
      }
    </style>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Invoice
        <small>#{{ $order->invoice_number }}</small>
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
          
          <form role="form" target="_blank" class="pull-right" method="POST" action="{{ url(config('backpack.base.route_prefix', 'admin').'/order/id/' . $order->id . '/export/billing') }}">
              @csrf
              <button type="submit" class="btn btn-success">Print Invoice</button>
          </form>
          @if($order->last_billing_status != 'refund')
          <a style="float: right;" class="btn btn-danger" onclick="return confirm('Are you want to refund this order?');" href="{{ url(config('backpack.base.route_prefix', 'admin').'/order/refund/'.$order->id) }}">
            Refund
          </a>
          @endif
<!--           <form role="form" class="pull-right" method="POST" action="{{ url(config('backpack.base.route_prefix', 'admin').'/order/id/' . $order->id . '/export/shipping') }}" style="margin-right: 10px;">
              @csrf
              <button type="submit" class="btn btn-success">Export Packing List</button>
          </form> -->
        </div>
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> YUM Organic Farm
            <small class="pull-right">Date: <?php echo date('m/d/Y', strtotime($order->created_at)) ?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      

      <div class="main">
        <div class="css-cart">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-8">
                        <div class="box-info">
                            <div class="info-detail">
                                <div><span>@lang('yum.order_number')</span> {{ $order->invoice_number }}</div>
                            </div>
                            <div class="bdr-detail">
                                <div class="pad-cart">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="title2-cart">@lang('yum.date_time')</div>
                                            <div class="bdy-cart">
                                                <p>{{ date('l, d F Y H:i', strtotime($order->created_at)) }}</p>
                                            </div>
                                            <div class="title2-cart">@lang('yum.customer_information')</div>
                                            <div class="bdy-cart">
                                                <b>{{ $order->order_shipping_address->first_name }} {{ $order->order_shipping_address->last_name }}</b>
                                                <p>{{ $order->order_shipping_address->phone_number }}</p>
                                                <p>{{ $order->order_shipping_address->email }}</p>
                                                <p>{{ $order->order_shipping_address->address }}</p>
                                                <p>{{ $order->order_shipping_address->district }}, {{ $order->order_shipping_address->city }}, {{ $order->order_shipping_address->province }}, {{ $order->order_shipping_address->country }} {{ $order->order_shipping_address->zip_code }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb40">
                                                <div class="title2-cart">@lang('yum.shipping_method')</div>
                                                <div class="bdy-cart">
                                                    <p>@if($order->shipping_method == 'delivery') @lang('yum.delivery_checkout') @else @lang('yum.pick_up') - @endif @if($order->shipping_method == 'delivery'), {{ ucwords($order->shipping_type) }} <?php if($order->shipping_type == 'Instant'){ ?> (&#60;2 hours) <?php }else{ ?> (&#60;8 hours) <?php } ?> - Rp {{ number_format($order->shipping_fee,0,",",".") }} @else @lang('yum.free_shipping') @endif</p>
                                                </div>
                                            </div>
                                            <div class="title2-cart">@lang('yum.payment_method')</div>
                                                <div class="bdy-cart">
                                                    <p>@if($payment_type) @if($order->payment_method == 'midtrans') Midtrans - @endif @if($order->payment_type == 'bank_transfer') @lang('yum.bank_transfer_to') {{ strtoupper($order->bank) }} @else {{ $payment_type }} @endif @else {{ ucwords($order->payment_method) }} @endif</p>
                                                </div>
                                                @if($payment_type == 'Bank Transfer')
                                                <div class="title2-cart">@lang('yum.payment_deadline')</div>
                                                <div class="bdy-cart">
                                                    <p>{{ date('l, d F Y H:i', strtotime($order->expiry_date)) }}</p>
                                                </div>
                                                @endif
                                        </div>
                                    </div>
                                    <!--<div class="title2-cart">@lang('yum.order')</div>-->
                                </div>
                                <div class="table-order">
                                    <div class="row t">
                                        <div class="col-md-4">@lang('yum.checkout_item')</div>
                                        <div class="col-md-4 text-center">@lang('yum.checkout_qty')</div>
                                        <div class="col-md-4 text-right">@lang('yum.price')</div>
                                    </div>
                                    <div class="bdr2">
                                        @foreach($order->order_details as $list)
                                        <div class="row bdy">
                                            <div class="col-md-5">
                                                <div class="tbl tbl-detail">
                                                    <div class="cell img">
                                                        <div class="in">
                                                            @if(isset($list->product->product_image[0]))
                                                            <img src="{{asset('upload/product/'.$list->product->product_image[0]->image)}}" title="" alt=""/>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="cell">
                                                        <div class="nm-product">{{ $list->product_name }}</div>
                                                        @if($list->product_discount > 0)
                                                            <div class="price-product disc"><span>Rp {{ number_format($list->product_original_price,0,",",".") }}</span> Rp {{ number_format($list->product_price,0,",",".") }} ({{ $list->product_discount }}% OFF)</div>
                                                        @else
                                                            <div class="price-product"><span>Rp {{ number_format($list->product_price,0,",",".") }}</span></div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 text-center"><br />{{ $list->product_quantity }}<br /></div>
                                            <div class="col-md-5 text-right"><br />Rp {{ number_format($list->product_price * $list->product_quantity,0,",",".") }}<br /></div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="table-order">
                                    <div class="row last">

                                        <div class="col-md-8 offset-md-4 col-lg-12 offset-lg-5">
                                            <div class="row">
                                                <div class="col-md-10 text-right">
                                                    <!-- <div class="t-total">Subtotal</div> -->Subtotal
                                                </div>
                                                <div class="col-md-2 text-right">
                                                    <div class="t-price">Rp. {{ number_format($order->sub_total,0,",",".") }}</div>
                                                </div>
                                            </div>
                                            @if($order->discount_price > 0)
                                            <div class="row">
                                                <div class="col-md-10 text-right">
                                                    <!-- <div class="t-total">Subtotal</div> -->@lang('yum.coupon')
                                                </div>
                                                <div class="col-md-2 text-right">
                                                    <div class="t-price">-Rp. {{ number_format($order->discount_price,0,",",".") }}</div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="row">
                                                <div class="col-md-10 text-right">
                                                    <!-- <div class="t-total">@lang('yum.shipping')</div> -->@lang('yum.shipping')
                                                </div>
                                                <div class="col-md-2 text-right">
                                                    <div class="t-price">Rp. {{ number_format($order->shipping_fee,0,",",".") }}</div>
                                                </div>
                                            </div>
                                            @if($payment_type == 'Paypal')
                                              <div class="row">
                                                  <div class="col-md-10 text-right">
                                                    Paypal Fee
                                                  </div>
                                                  <div class="col-md-2 text-right">
                                                      <div class="t-price">Rp. {{ number_format($order->paypal_fee,0,",",".") }}</div>
                                                  </div>
                                              </div>
                                            @endif
                                            <div class="row big bold text-right">
                                                <div class="col-md-10">
                                                    <!-- <div class="t-total">@lang('yum.email_grand_total')</div> -->@lang('yum.email_grand_total')
                                                </div>
                                                <div class="col-md-2 text-right">
                                                    <div class="t-price">Rp. {{ number_format($order->total_price,0,",",".") }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


      <br><br>
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
            @foreach($order->order_shipping_details as $lists)
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
            @foreach($order->order_billing_details as $bill)
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
