@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Report by Product
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">{{ trans('vendor.backpack.base.base.dashboard') }}</li>
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
        <div class="col-md-9">
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
              <input type="text" @if($date_filter != 5) style="display: none;" @endif class="form-control " name="date" id="dashboarddate" value="{{ $daterange }}">

                  <!-- /.input group -->
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
          <br>
          <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard/export_report_product') }}">
                                @csrf
                                <input type="hidden" name="date_filter" value="{{ $date_filter }}">
                                <input type="hidden" name="date" value="{{ $daterange }}">
                                <button type="submit" class="btn btn-success">Export Product Report</button>
                                
          </form>
        </div>
      </div>
      <br>

      <div class="row">
        <div class="col-md-7">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Top Seller Product</h3>

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
                    <th>Product Price</th>
                    <!-- <th>Discount Price</th> -->
                    <th>Total Product Selling</th>
                    <th style="width: 87px;">Total Sale</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data['top_product'] as $list)
                  <tr>
                    <td><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard/report_product?topproduct='.$list->product_variant_id.'&date_filter='.$date_filter.'&date='.$daterange) }}">{{ $list->product_variant->product->name }} @if($list->product_variant->size) ( {{ $list->product_variant->size }} - {{ $list->product_variant->color }} ) @endif</a></td>
                    <td>IDR {{ number_format($list->product_variant->product->price ,0,",",".") }} </td>
                    <!-- <td>$ {{ $list->product_variant->price - $list->product_variant->discount_nominal }}</td> -->
                    <td>{{ $list->total_product }}</td>
                    <td>IDR {{ number_format($list->total_selling ,0,",",".") }}</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        @if(count($data['chart']) > 0)
          <div class="col-md-5">
              <p class="text-center">
                    <strong>Product Selling for {{ $data['product_name']->product->name }}</strong>
              </p>

              <div class="chart">
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 450px;"></div>
              </div>
                  <!-- /.chart-responsive -->
          </div>
                @endif
        <!-- /.col -->
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
        {y: '<?php echo $list->year; ?>-<?php echo $list->month; ?>-<?php echo $list->day; ?>', item1: <?php echo $list->total_selling; ?>},
      <?php $i++; } ?>
    ],
    xkey      : 'y',
    ykeys     : ['item1'],
    labels    : ['Total Selling'],
    lineColors: ['#f39c12'],
    hideHover : 'auto',

  });
  
</script>
@endsection