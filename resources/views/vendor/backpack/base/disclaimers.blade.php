@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Disclaimers
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Disclaimers</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    Update Disclaimers
                </div>

                <div class="box-body">
               
                        <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/disclaimers/update') }}" enctype="multipart/form-data">
                          {!! csrf_field() !!}
                          <div class="form-group">
                            <label for="exampleInputEmail1">Disclaimers</label>
                            <textarea name="disclaimers" class="form-control my-editor" style="height: 300px;">@if(isset($data->disclaimers)) {{ $data->disclaimers }} @endif</textarea>
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        
                </div>
            </div>
        </div>
    </div>
@endsection
