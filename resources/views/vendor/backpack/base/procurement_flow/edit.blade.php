@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Procurement Flow
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Procurement Flow</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    Update Procurement Flow
                </div>

                <div class="box-body">
                  
                          <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/procurement_flow/update') }}" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="form-group @if($errors->has('name')) has-error @endif">
                              <label for="exampleInputEmail1">Title</label>
                              <input type="text" name="title" value="{{ $data->title }}" class="form-control">
                              @if($errors->has('title')) <span class="help-block">{{ $errors->first('title') }}</span>  @endif
                            </div>
                            
                            <div class="form-group @if($errors->has('image')) has-error @endif">
                              <label for="exampleInputEmail1">Image</label>
                              <input type="file" name="image" class="form-control">
                              <img src="{{ asset('/upload/procurement_flow/'.$data->image) }}" width="40%" />
                              @if($errors->has('image')) <span class="help-block">{{ $errors->first('image') }}</span>  @endif
                              <input type="hidden" name="old_image" value="{{ $data->image }}">
                            </div>

                            <div class="form-group @if($errors->has('image_active')) has-error @endif">
                              <label for="exampleInputEmail1">Image Active</label>
                              <input type="file" name="image_active" class="form-control">
                              <img src="{{ asset('/upload/procurement_flow/'.$data->image_active) }}" width="40%" />
                              @if($errors->has('image_active')) <span class="help-block">{{ $errors->first('image_active') }}</span>  @endif
                              <input type="hidden" name="old_image_active" value="{{ $data->image_active }}">
                            </div>

                            <div class="form-group @if($errors->has('description')) has-error  @endif">
                              <label for="exampleInputEmail1">Description</label>
                              <textarea name="description" class="form-control my-editor">{{ $data->description }}</textarea>
                              @if($errors->has('description')) <span class="help-block">{{ $errors->first('description') }}</span>  @endif
                            </div>

                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </form>
                  </div>
            </div>
        </div>
    </div>
@endsection
