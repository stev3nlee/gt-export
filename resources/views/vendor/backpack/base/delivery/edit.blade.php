@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Delivery day {{ $data->day }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Delivery day {{ $data->day }}</li>
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
                    <div class="col-md-6">
                       <!--  <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix', 'admin').'/delivery/update') }}">
                                @csrf
                        <div class="form-group " style="display: flex;">
                            <label for="exampleInputEmail1">Max Number Of Orders</label>
                            <input type="number" name="max_order" value="{{ $data->max_order }}"  class="form-control" style="flex-grow: 1; " width="30%">
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>

                          </div>
                        </form> -->

                        <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix', 'admin').'/delivery/update_time') }}">
                                @csrf
                        <div class="dataTable_wrapper table-responsive">
                            <table class="table table-striped table-bordered table-hover ">
                                <thead>
                                    <tr class="nosortable">
                                        <th>Time Slot</th>
                                        <th>Status(On/Off)</th>
                                        <th>Max Order</th>
                                    </tr>
                                </thead>
                                <tbody id="element-order">
                                  @foreach ($data->delivery_time as $content)
                                        <tr>
                                            <td>{{ $content->time }}</td>
                                            <td><input type="checkbox" name="time[]" value="{{ $content->id }}" @if($content->pivot->status == 1) checked @endif></td>
                                            <td><input type="number" name="max_order_{{ $content->pivot->id }}" value="{{ $content->pivot->max_order }}"  class="form-control" style="width: 70px;"> </td>
                                        </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                        <input type="hidden" name="id" value="{{ $data->id }}">

                        <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                    <!-- /.table-responsive -->
                </div>
            </div>
        </div>
    </div>

    
@endsection