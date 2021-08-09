@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Production Detail {{ date('d F Y', strtotime($date)) }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Production Detail</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-body">
                  <!--   <div class="row">
                        <div class="col-md-12 text-right">
                            <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix', 'admin').'/production/generate') }}">
                                @csrf
                                
                                <div style="display: inline-block;vertical-align: middle;">
                                    <button type="submit" class="btn btn-success">Generate Production</button>
                                </div>
                            </form>
                        </div>
                        
                    </div> -->

                    <div class="dataTable_wrapper table-responsive">
                        <table class="table table-striped table-bordered table-hover datatable " id="dataTable">
                            <thead>
                                <tr class="nosortable">
                                    <th></th>
                                    <th>Date</th>
                                    <th>Invoice</th>
                                    <th>Member</th>
                                    <th>Plan</th>
                                    <th>Delivery Time</th>
                                    <th>Meal</th>
                                </tr>
                            </thead>
                            <tbody id="element-order">
                              @foreach ($data as $content)
                                    <tr>
                                        <td>
                                        <div class="table-actions-hover">
                                                <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/production/print/'.$content->id) }}"><i class="fa fa-print fa-fw"></i></a>
                                        </div>
                                        </td>
                                        <td>{{ $content->date }}</td>
                                        <td>{{ $content->order->invoice_number }}</td>
                                        <td>{{ $content->order->member->name }}</td>
                                        <td>{{ $content->order->plan_meal }} meal a week</td>
                                        <td>{{ $content->order->day_delivery }} {{ $content->order->time_delivery }}</td>
                                        <td><ul>
                                        @foreach($content->production_schedule_detail as $detail)
                                        <li>{{ $detail->product_name }}</li>
                                        @endforeach
                                        </ul></td>
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