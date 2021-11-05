@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Procurement Flow Title
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Procurement Flow Title</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    Update Procurement Flow Title
                </div>

                <div class="box-body">
                    <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/procurement_flow/update_title') }}" enctype="multipart/form-data">
                      {!! csrf_field() !!}
                      
                      <div class="form-group">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" name="title" class="form-control" value="@if(isset($data->title)){{ $data->title }}@endif">
                      </div>

                      <div class="form-group">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea name="description" class="form-control my-editor">@if(isset($data->description)){{ $data->description }} @endif</textarea>
                      </div>

                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
