@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Delivery Time
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Delivery Time</li>
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
                        <!-- <div class="col-md-12 text-right">
                            <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix', 'admin').'/delivery/generate') }}">
                                @csrf
                                
                                <div style="display: inline-block;vertical-align: middle;">
                                    <button type="submit" class="btn btn-success">Generate delivery</button>
                                </div>
                            </form>
                        </div> -->
                        
                    </div>

                    <div class="dataTable_wrapper table-responsive">
                        <table class="table table-striped table-bordered table-hover datatable ">
                            <thead>
                                <tr class="nosortable">
                                    <th class="table-actions">Action</th>
                                    <th>Day</th>
                                    <th>Time</th>
                                    <th>Max Order</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="element-order">
                              @foreach ($data as $key=>$content)
                                    <tr>
                                        <td>
                                        <div class="table-actions-hover">
                                                <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/delivery/edit/'.$content->id) }}"><i class="fa fa-pencil fa-fw"></i></a>
                                            </div>
                                        </td>
                                        <td>{{ $content->day }}</td>
                                        <td><ul>
                                        <?php $max_order=0; ?>
                                        @foreach($content->delivery_time as $detail)
                                        <li>{{ $detail->time }} ({{ $detail->pivot->status ? 'ON' : 'OFF' }}) <b>({{ $detail->pivot->max_order }} left)</b></li>
                                        <?php $max_order += $detail->pivot->max_order; ?>
                                        @endforeach
                                        </ul>
                                        <td>{{ $max_order }}</td>
                                        </td>
                                        <td><?php if($content->status == 0){ ?><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/delivery/status/'.$content->id.'/1') }}"><span class="badge bg-red">Inactive</span></a><?php  }else{ ?><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/delivery/status/'.$content->id.'/0') }}"><span class="badge bg-green">Active</span></a><?php } ?></td>
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
