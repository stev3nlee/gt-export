@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Reservation Time
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Reservation Time</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    Update Reservation Time
                </div>

                <div class="box-body">
                  @include('vendor.backpack.base.inc.alert')
                    <div class="col-md-4">
                        <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/reservation_time/update') }}" enctype="multipart/form-data">
                          {!! csrf_field() !!}
                        

                          <div class="form-group">
                            <label for="exampleInputEmail1">Hours</label>
                            <input name="hours" type="number" class="form-control" value="@if(isset($data->hours)){{ $data->hours }}@endif">
                          </div>

                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
