@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Port
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Port</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                  @include('vendor.backpack.base.inc.alert')
                    Create Port
                </div>

                <div class="box-body">
                      <div class="col-md-6">
                        <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/port/insert') }}" enctype="multipart/form-data">
                          {!! csrf_field() !!}
                          <div class="form-group">
                            <label for="exampleInputEmail1">Port</label>
                            <input type="text" name="port" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Country</label>
                            <select name="country_id" class="form-control" required>
                              <option value="">Select Country</option>
                              @foreach($countries as $country)
                              <option value="{{ $country->id }}">{{ $country->country }}</option>
                              @endforeach
                            </select>
                            
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Shipping Cost</label>
                            <input type="number" step=".01" name="shipping_cost" class="form-control" id="shipping_cost" >
                          </div>
                          
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                      </div>
                </div>
            </div>
        </div>
    </div>
@endsection
