@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Dashboard
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>
@endsection


@section('content')
<style>
  .info-box{
    min-height: 0;
  }
  .info-box-content {
    margin-left: 0;
  }
  .info-box-text {
    font-size: 13px;
  }
</style>
      <div class="row">
        <div class="col-md-7">
          <form class="form-inline" method="GET">
            <div class="form-group">
              <label>Filter:</label>
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <select class="form-control" id="date_filter" name="date_filter">
                  <option value="0">All</option>
                  <option value="1" @if($date_filter == 1) selected @endif>Last 7 Days</option>
                  <option value="2" @if($date_filter == 2) selected @endif>This Month</option>
                  <option value="3" @if($date_filter == 3) selected @endif>Last Month</option>
                  <option value="4" @if($date_filter == 4) selected @endif>Year</option>
                  <option value="5" @if($date_filter == 5) selected @endif>Custom</option>
                </select>
                
              </div>
              <input type="text" @if($date_filter != 5) style="display: none;" @endif class="form-control pull-right" name="date" id="dashboarddate" value="{{ $daterange }}">
                  <!-- /.input group -->
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{ $data['total_product'] }}</h3>

              <p>Total Meals</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-restaurant"></i>
            </div>
            <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/meal') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $data['total_order'] }}</h3>

              <p>Total Subscription</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/order') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $data['total_member'] }}</h3>

              <p>Total Members</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/member') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $data['item_purchased'] }}</h3>

              <p>Meal Purchased</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/order') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        
        <!-- /.col -->
        <!-- /.col -->
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Recap Report</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <!-- <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong> -->
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <div class="chart tab-pane active" id="revenue-chart"></div>
                    <!-- <canvas id="salesChart" style="height: 180px;"></canvas> -->
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <!-- <p class="text-center">
                    <strong>Goal Completion</strong>
                  </p>

                  <div class="progress-group">
                    <span class="progress-text">Add Products to Cart</span>
                    <span class="progress-number"><b>160</b>/200</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                    </div>
                  </div>
                  <div class="progress-group">
                    <span class="progress-text">Complete Purchase</span>
                    <span class="progress-number"><b>310</b>/400</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                    </div>
                  </div>
                  <div class="progress-group">
                    <span class="progress-text">Visit Premium Page</span>
                    <span class="progress-number"><b>480</b>/800</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: 80%"></div>
                    </div>
                  </div>
                  <div class="progress-group">
                    <span class="progress-text">Send Inquiries</span>
                    <span class="progress-number"><b>250</b>/500</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width: 80%"></div>
                    </div>
                  </div> -->
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- <div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 17%</span>
                    <h5 class="description-header">$35,210.43</h5>
                    <span class="description-text">TOTAL REVENUE</span>
                  </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> 0%</span>
                    <h5 class="description-header">$10,390.90</h5>
                    <span class="description-text">TOTAL COST</span>
                  </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> 20%</span>
                    <h5 class="description-header">$24,813.53</h5>
                    <span class="description-text">TOTAL PROFIT</span>
                  </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> 18%</span>
                    <h5 class="description-header">1200</h5>
                    <span class="description-text">GOAL COMPLETIONS</span>
                  </div>
                </div>
              </div>
            </div> -->
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>

      <div class="row">
        
            <div class="col-md-6">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Members</h3>

                  <div class="box-tools pull-right">
                    <span class="label label-danger">{{ count($data['latest_member']) }} New Members</span>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                    @foreach($data['latest_member'] as $list)
                    <li>
                      <span class="glyphicon glyphicon-user" style="font-size: 29px;"></span>
                      <a class="users-list-name" href="{{ url(config('backpack.base.route_prefix', 'admin').'/member/detail/'.$list->id) }}">@if($list->name == null) Guest @else{{ ucwords(strtolower($list->name)) }} @endif</a>
                      <span class="users-list-date">{{ $list->created_at }}</span>
                    </li>
                    @endforeach
                  </ul>
                  <!-- /.users-list -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                  <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/member') }}" class="uppercase">View All Members</a>
                </div>
                <!-- /.box-footer -->
              </div>
              <!--/.box -->
            </div>
            <!-- /.col -->

            <div class="col-md-6">
              <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Subscription</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Total</th>
                    <th>Subscription Status</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data['latest_order'] as $val)
                  <tr>
                    <td><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/order/detail/'.$val->id) }}">{{ $val->order->invoice_number }}</a></td>
                    <td>SGD {{ number_format($val->order->total_price, 2, '.', '') }}</td>
                    <td><span class="label label-success">@if ($val->stripe_status == 'active')
                                                Active
                                            @elseif ($val->stripe_status == 'trialing')
                                                Trial
                                            @elseif ($val->stripe_status == 'past_due')
                                                Past Due
                                            @elseif ($val->stripe_status == 'unpaid')
                                                Unpaid
                                            @elseif ($val->stripe_status == 'canceled')
                                                Cancelled
                                            @elseif ($val->stripe_status == 'incomplete')
                                                Incomplete
                                            @elseif ($val->stripe_status == 'incomplete_expired')
                                                Incomplete Expired
                                            @elseif ($val->stripe_status == 'all')
                                                All
                                            @elseif ($val->stripe_status == 'ended')
                                                Ended
                                            @endif</span></td>
                  </tr>
                  @endforeach

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/order') }}" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a>
            </div>
            <!-- /.box-footer -->
          </div>
            </div>
          </div>
          

        </div>
        



@endsection
@section('after_scripts')
<script>
  $('#date_filter').on('change', function() {
    if(this.value == 5){
      $('#dashboarddate').show();
    }else{
      $('#dashboarddate').hide();
    }
  });
    // Sales chart
  var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
  var area = new Morris.Line({
    element   : 'revenue-chart',
    resize    : true,
    data      : [
      <?php $i=1; foreach ($data['chart'] as $list){ ?>
        {y: '<?php echo $list->year; ?>-<?php echo $list->month; ?>-<?php echo $list->day; ?>', item1: <?php echo $list->total_subscription; ?>},
      <?php $i++; } ?>
    ],
    xkey      : 'y',
    ykeys     : ['item1'],
    labels    : ['Subscripiton'],
    lineColors: ['#f39c12', '#FE1717', '#27872E'],
    hideHover : 'auto',

  });
  
</script>
@endsection