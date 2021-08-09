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
                <div class="box-body">
                    <!-- <div class="row">
                        <div class="col-md-10 text-right">
                            <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix', 'admin').'/order/exportToExcel') }}">
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
                                <div style="display: inline-block;vertical-align: middle;">
                                    <button type="submit" class="btn btn-success">Export Sales Report</button>
                                </div>
                            </form>
                        </div>
                    </div> -->

                    <div class="dataTable_wrapper table-responsive">
                        <table id="dataTable" class="table table-striped table-bordered table-hover datatable ">
                            <thead>
                                <tr class="nosortable">
                                    <th class="table-actions">Actions</th>
                                    <th>Invoice</th>
                                    <th>Buyer</th>
                                    <th>Transaction Date</th>
                                    <th>Amount</th>
                                    <th>Payment To</th>
                                    <th>Recepit</th>
                                    <th>Sender Name</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="element-order">
                              @foreach ($data as $content)
                                    <tr>
                                        <td>
                                        <div class="table-actions-hover">
                                                <a onclick="return confirm('Are you sure ?');" href="{{ url(config('backpack.base.route_prefix', 'admin').'/order/delete/'.$content->id) }}"><i class="fa fa-trash fa-fw"></i></a>
                                            </div>
                                        </td>
                                        <td>{{ $content->order_no }}</td>
                                        <td>@if($content->member) {{ ucwords(strtolower($content->member->first_name)) . ' ' . ucwords(strtolower($content->member->last_name)) }} @else Guest @endif</td>
                                        <td>{{ $content->date }}</td>
                                        <td>IDR {{ number_format($content->amount ,0,",",".") }}</td>
                                        <td>{{ $content->payment_to }}</td>
                                        <td>
                                            <img src="{{ asset('/upload/receipt/'.$content->image) }}" width="40%"/>
                                        </td>
                                        <td>{{ $content->account_holder }}</td>
                                        <td>
                                            @if ($content->status == 'paid')
                                                Paid
                                            @elseif ($content->status == 'failed')
                                                Failed
                                            @elseif ($content->status == 'unpaid')
                                                Abandoned Cart
                                            @elseif ($content->status == 'waiting_for_payment')
                                                Waiting for payment
                                            @elseif ($content->status == 'cancel')
                                                Cancelled
                                            @elseif ($content->status == 'expired')
                                                Expired
                                            @elseif ($content->status == 'payment_confirmation')
                                                Payment Confirmation
                                            @endif
                                        </td>
                                        <td>@if($content->status == 'payment_verification')
                                            <a class="btn btn-success" onclick="return confirm('Are you want to set this order to paid ?');" href="{{ url(config('backpack.base.route_prefix', 'admin').'/order-payment/vefiry/'.$content->id) }}">Set as Paid</a>
                                            @else
                                            Verified
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
