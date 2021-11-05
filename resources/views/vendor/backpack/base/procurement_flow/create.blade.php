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
                    Create Procurement Flow
                </div>

                <div class="box-body">
                    <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/procurement_flow/insert') }}" enctype="multipart/form-data">
                      {!! csrf_field() !!}
                      <div class="form-group @if($errors->has('title')) has-error @endif">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" name="title" class="form-control">
                        @if($errors->has('title')) <span class="help-block">{{ $errors->first('title') }}</span>  @endif
                      </div>
                      
                      <div class="form-group @if($errors->has('image')) has-error @endif">
                        <label for="exampleInputEmail1">Image</label>
                        <input type="file" name="image" class="form-control" required="required">
                        @if($errors->has('image')) <span class="help-block">{{ $errors->first('image') }}</span>  @endif
                      </div>

                      <div class="form-group @if($errors->has('image_active')) has-error @endif">
                        <label for="exampleInputEmail1">Image Active</label>
                        <input type="file" name="image_active" class="form-control" required="required">
                        @if($errors->has('image_active')) <span class="help-block">{{ $errors->first('image_active') }}</span>  @endif
                      </div>

                      <div class="form-group @if($errors->has('description')) has-error  @endif">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea name="description" class="form-control my-editor"></textarea>
                        @if($errors->has('description')) <span class="help-block">{{ $errors->first('description') }}</span>  @endif
                      </div>
                  
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
