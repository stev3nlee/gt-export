@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Country
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Country</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                  @include('vendor.backpack.base.inc.alert')
                    Create Country
                </div>

                <div class="box-body">
                      <div class="col-md-6">
                        <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/country/insert') }}" enctype="multipart/form-data">
                          {!! csrf_field() !!}
                          <div class="form-group">
                            <label for="exampleInputEmail1">Country</label>
                            <input type="text" name="country" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Country Code</label>
                            <input type="text" name="country_code" class="form-control">
                          </div>
                          <!-- <div class="form-group">
                            <label for="exampleInputEmail1">Shipping Cost</label>
                            <input type="number" step=".01" name="shipping_cost" class="form-control" id="shipping_cost" >
                          </div> -->
                          
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                      </div>
                </div>
            </div>
        </div>
    </div>
@endsection
