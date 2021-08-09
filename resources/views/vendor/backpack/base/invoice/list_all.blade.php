@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Order
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Order</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                @include('vendor.backpack.base.inc.alert')
                <div class="box-body">
                    <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix', 'admin').'/order_secret/exportToExcel') }}">
                        @csrf
                        <button type="submit" class="btn btn-success">Export All Sales Report</button>
                    </form>

                    <div class="dataTable_wrapper table-responsive">
                        <table id="dataTable" class="table table-striped table-bordered table-hover datatable ">
                            <thead>
                                <tr class="nosortable">
                                    <th class="table-actions">Actions</th>
                                    <th>ID</th>
                                    <th>Invoice</th>
                                    <th>Buyer</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Total Order</th>
                                    <th>Point Earned</th>
                                    <th>Payment Method</th>
                                    <!-- <th>Status</th> -->
                                    <th>Created Date</th>
                                    <th>Shipping Status</th>
                                    <th>Billing Status</th>
                                    <th>Packing List Printed</th>
                                    <th>Invoice Printed</th>
                                    <th>Change Status to Paid</th>
                                    <th>Cancel</th>
                                    <th>Send Email</th>
                                </tr>
                            </thead>
                            <tbody id="element-order">
                              @foreach ($data as $content)
                                    <tr>
                                        <td>
                                        <div class="table-actions-hover">
                                                <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/order/detail/'.$content->id) }}">Detail</a>
                                                <!-- <a onclick="return confirm('Are you sure ?');" href="{{ url(config('backpack.base.route_prefix', 'admin').'/order/delete/'.$content->id) }}"><i class="fa fa-trash fa-fw"></i></a> -->
                                            </div>
                                        </td>
                                        <td>{{ $content->id }}</td>
                                        <td>{{ $content->invoice_number }}</td>
                                        <td>{{ $content->member ? $content->member->first_name . ' ' . $content->member->last_name : 'Guest' }}</td>
                                        <td>{{ $content->order_billing_address->email }}</td>
                                        <td>{{ $content->order_billing_address->phone_number }}</td>
                                        <td>${{ $content->total_price }}</td>
                                        <td>{{ $content->point_earned }}</td>
                                        <td>
                                            @if ($content->payment_method == 'cod')
                                                Cash on Delivery
                                            @else
                                                Credit Card
                                            @endif
                                        </td>
                                        <?php /* if($content->status == 1){ 
                                                $label = 'warning';
                                                $status = 'Pending';
                                            }else if($content->status == 2){
                                                $label = 'success';
                                                $status = 'Success';
                                            }else{
                                                $label = 'danger';
                                                $status = 'Cancel';
                                            } 
                                        <td><span class="label label-{{ $label }}">{{ $status }}</span></td>*/
                                        ?>
                                        <td>{{ $content->created_at }}</td>
                                        <td>
                                            @if ($content->last_shipping_status == 'checkout')
                                                Checkout
                                            @elseif ($content->last_shipping_status == 'loading_goods')
                                                Loading Goods
                                            @elseif ($content->last_shipping_status == 'returned')
                                                Returned
                                            @elseif ($content->last_shipping_status == 'delivering')
                                                Delivering
                                            @elseif ($content->last_shipping_status == 'delivered')
                                                Delivered
                                            @elseif ($content->last_shipping_status == 'failed')
                                                Failed
                                            @elseif ($content->last_shipping_status == 'order_confirmed')
                                                Order Confirmed
                                            @elseif ($content->last_shipping_status == 'partners_sorting_centre')
                                                Partners Sorting Centre
                                            @else
                                                {{ $content->last_shipping_status }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($content->last_billing_status == 'paid')
                                                Paid
                                            @elseif ($content->last_billing_status == 'failed')
                                                Failed
                                            @elseif ($content->last_billing_status == 'unpaid')
                                                Abandoned Cart
                                            @elseif ($content->last_billing_status == 'waiting_for_payment')
                                                Waiting for payment
                                            @elseif ($content->last_billing_status == 'cancel')
                                                Cancelled
                                            @endif

                                        </td>
                                        <td>
                                            @if ($content->shipping_printed == 1)
                                                <i class="fa fa-check"></i>
                                            @else
                                                <i class="fa fa-times"></i>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($content->billing_printed == 1)
                                                <i class="fa fa-check"></i>
                                            @else
                                                <i class="fa fa-times"></i>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($content->last_billing_status != 'paid')
                                                <a onclick="return confirm('Are you want to change to paid ?');" href="{{ env('BACKPANEL_URL') }}/api/v1/billing/sgepay_manual/callback?BillNo={{ $content->invoice_number }}&orderId=&UEihzFG8huQZ=1">Change to Paid</a>
                                            @else
                                                {{ $content->last_billing_status }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($content->last_billing_status != 'paid' && $content->last_billing_status != 'cancel')
                                                <a onclick="return confirm('Are you want to change to paid ?');" href="{{ url(config('backpack.base.route_prefix', 'admin').'/order/cancel/'.$content->id) }}">Cancel Order</a>
                                            @else
                                                {{ $content->last_billing_status }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($content->last_billing_status == 'paid')
                                                <a onclick="return confirm('Are you want to send email confirmation ?');" href="{{ url(config('backpack.base.route_prefix', 'admin').'/order/send_email/'.$content->tracking_number) }}">Send Email Confirmation</a>
                                            @else
                                                No Tracking Number
                                            @endif
                                        </td>
                                    </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
    </div>

    
@endsection
<script>
    // $(document).ready(function() {
    //     let page = 1;
    //     $('#dataTable').DataTable( {
    //         "processing": true,
    //         "serverSide": true,
    //         "ajax": {
    //             "url": "{{ url(config('backpack.base.route_prefix', 'admin') . '/order/get?page=' . " + page + ") }}",
    //             "dataType": "json",
    //             "type": "GET",
    //             "data": { _token: "{{csrf_token()}}"}
    //         },
    //         "deferRender": true,
    //         "columns": [
    //             { data: 'id', name: 'id' },
    //             { data: 'name', name: 'name' },
    //             { data: 'email', name: 'email' },
    //             { data: 'created_at', name: 'created_at' },
    //             { data: 'updated_at', name: 'updated_at' }
    //         ]
    
    //     } );
    // } );
</script>
