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

              <p>Total Product</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/product') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{ $data['total_quotation'] }}</h3>

              <p>Total Quotation</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/quotation') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{ $data['total_invoice'] }}</h3>

              <p>Total Invoice</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/invoice') }}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        
        <!-- /.col -->
        <!-- /.col -->
      </div>
      <?php /* ?>
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Sales Recap Report</h3>
              <!-- <a class="btn btn-primary" style="float: right;" href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard/report_product') }}">View Report by Product</a> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-3">
                  <div class="info-box bg-yellow">
                    <div class="info-box-content">
                      <span class="info-box-text">Gross sales in this period</span>
                      <span class="info-box-number">IDR {{ number_format($data['gross_sales'] ,0,",",".") }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>

                  <div class="info-box bg-green">
                    <div class="info-box-content">
                      <span class="info-box-text">Average gross daily sales</span>
                      <span class="info-box-number">IDR {{ number_format($data['average_gross'] ,0,",",".") }}</span>
                      
                    </div>
                    <!-- /.info-box-content -->
                  </div>

                  <div class="info-box bg-red">
                    <div class="info-box-content">
                      <span class="info-box-text">Net sales in this period</span>
                      <span class="info-box-number">IDR {{ number_format($data['net_sales'] ,0,",",".") }}</span>

                    </div>
                    <!-- /.info-box-content -->
                  </div>

                  <div class="info-box bg-aqua">
                    <div class="info-box-content">
                      <span class="info-box-text">Average net daily sales</span>
                      <span class="info-box-number">IDR {{ number_format($data['average_daily_net'] ,0,",",".") }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>

                  <!-- <div class="info-box bg-blue">
                    <div class="info-box-content">
                      <span class="info-box-text">Discount Product</span>
                      <span class="info-box-number">IDR {{ number_format($data['discount_given'] ,0,",",".") }}</span>
                    </div>
                  </div> -->

                  <div class="info-box bg-black">
                    <div class="info-box-content">
                      <span class="info-box-text">Charge for shipping</span>
                      <span class="info-box-number">IDR {{ number_format($data['shipping_charge'] ,0,",",".") }}</span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>

                </div>

                <div class="col-md-9">
                  <p class="text-center">
                    <!-- <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong> -->
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    @if(count($data['chart']) == 0) No Data @endif
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 500px;"></div>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <?php */ ?>

      <div class="row">
            <?php /* ?>
            <div class="col-md-6">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Top Sales Product</h3>

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
                        <th>Product</th>
                        <th>Total Quantity</th>
                      </tr>
                      </thead>
                      <tbody>
                      

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <?php */ ?>

            <div class="col-md-6">
              <!-- USERS LIST -->
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Members</h3>

                  <div class="box-tools pull-right">
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
                      <a class="users-list-name" href="{{ url(config('backpack.base.route_prefix', 'admin').'/member/detail/'.$list->id) }}">{{ ucwords(strtolower($list->first_name)) }} {{ ucwords(strtolower($list->last_name)) }}</a>
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
                <h3 class="box-title">Latest Quotation</h3>

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
                      <th>Quotation</th>
                      <th>Buyer</th>
                      <th>Car</th>
                      <th>Amount</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data['latest_quotation'] as $val)
                    <tr>
                      <td>{{ $val->quotation_number }}</td>
                      <td>{{ ucwords(strtolower($val->first_name)) . ' ' . ucwords(strtolower($val->last_name)) }}</td>
                      <td>{{ $val->product->name }}</td>
                      <td>$ {{ number_format($val->price, 2, '.', ',')  }}</td>
                    </tr>
                    @endforeach

                    </tbody>
                  </table>
                </div>
                <!-- /.table-responsive -->
              </div>
            <!-- /.box-body -->
              <div class="box-footer clearfix">
                <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/quotation') }}" class="btn btn-sm btn-default btn-flat pull-right">View All Quotation</a>
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

  <?php /* ?>
    // Sales chart
  var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
  var area = new Morris.Line({
    element   : 'revenue-chart',
    resize    : true,
    data      : [
      <?php $i=1; foreach ($data['chart'] as $list){ ?>
        {y: '<?php echo $list->year; ?>-<?php echo $list->month; ?>-<?php echo $list->day; ?>', item1: <?php echo $list->total_order; ?>, item2: <?php echo $list->subtotal_order; ?>, item3: <?php echo $list->total_shipping; ?>},
      <?php $i++; } ?>
    ],
    xkey      : 'y',
    ykeys     : ['item1','item2','item3'],
    labels    : ['Gross Sales', 'Net Sales', 'Shipping'],
    lineColors: ['#f39c12', '#FE1717', '#27872E'],
    hideHover : 'auto',

  });
  <?php */ ?>
  
</script>
<!-- <script>
    // Sales chart
  var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
  var area = new Morris.Line({
    element   : 'revenue-chart',
    resize    : true,
    data      : [
    ],
    xkey      : 'y',
    ykeys     : ['item1'],
    labels    : ['Total Order'],
    lineColors: ['#a0d0e0', '#3c8dbc'],
    hideHover : 'auto',
    xLabelFormat: function(x) { // <--- x.getMonth() returns valid index
      var month = months[x.getMonth()];
      return month;
    },
    dateFormat: function(x) {
      var month = months[new Date(x).getMonth()];
      return month;
    },
  });
  
</script> -->
@endsection