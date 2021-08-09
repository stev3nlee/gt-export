@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Our Value
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Our Value</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    Update Our Value
                </div>

                <div class="box-body">
                  
                          <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/our_value/update') }}" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <div class="form-group @if($errors->has('title')) has-error @endif">
                              <label for="exampleInputEmail1">Title</label>
                              <input type="text" name="title" value="{{ $data->title }}" class="form-control">
                              @if($errors->has('title')) <span class="help-block">{{ $errors->first('title') }}</span>  @endif
                            </div>

                            <div class="form-group @if($errors->has('content')) has-error  @endif">
                              <label for="exampleInputEmail1">Content</label>
                              <textarea name="content" class="form-control my-editor">{{ $data->content }}</textarea>
                              @if($errors->has('content')) <span class="help-block">{{ $errors->first('content') }}</span>  @endif
                            </div>

                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </form>
                        
                  </div>
            </div>
        </div>
    </div>
@endsection
