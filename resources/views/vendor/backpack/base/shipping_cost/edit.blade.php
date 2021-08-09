@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Shipping Cost
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Shipping Cost</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                  @include('vendor.backpack.base.inc.alert')
                    Update Shipping Cost
                </div>

                <div class="box-body">
                    <div class="col-md-6">
                        <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/shipping_cost/update') }}" enctype="multipart/form-data">
                          {!! csrf_field() !!}
                          <div class="form-group">
                            <label for="exampleInputEmail1">Country</label>
                            <input type="text" name="country" class="form-control" value="{{ $data->country }}">
                          </div>
                          <div class="form-group">
                          <label for="exampleInputEmail1">Shipping Cost</label>
                            <input type="number" step=".01" name="shipping_cost" class="form-control" id="shipping_cost"  value="@if(isset($data->shipping_cost)){{ $data->shipping_cost }}@endif">
                        </div>
                          <input type="hidden" name="id" value="{{ $data->id }}">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
