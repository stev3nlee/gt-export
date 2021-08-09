@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Minimum Order
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Minimum Order</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    Update Minimum Order
                </div>

                <div class="box-body">
                        <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/minimum_order/update') }}" enctype="multipart/form-data">
                          {!! csrf_field() !!}
                        

                          <div class="form-group">
                            <label for="exampleInputEmail1">Minimum Order</label>
                            <input name="minimum_order" type="number" class="form-control" value="@if(isset($data->minimum_order)){{ $data->minimum_order }}@endif">
                          </div>

                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
@endsection
