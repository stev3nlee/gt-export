@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Blog
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Blog</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    Update Blog
                </div>

                <div class="box-body">
                      <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/blog/update') }}" enctype="multipart/form-data" novalidate>
                        {!! csrf_field() !!}
                        <div class="form-group @if($errors->has('title')) has-error  @endif">
                          <label for="exampleInputEmail1">Title</label>
                          <input type="text" name="title" class="form-control" required="required" value="{{ $data->title }}">
                          @if($errors->has('title')) <span class="help-block">{{ $errors->first('title') }}</span>  @endif
                        </div>

                        <div class="form-group @if($errors->has('image')) has-error  @endif">

                          <label for="exampleInputEmail1">Thumbnail</label><br> 
                          <img src="{{ asset('/upload/blog/'.$data->image) }}" width="20%" >
                          <input type="file" name="image" class="form-control">
                          @if($errors->has('image')) <span class="help-block">{{ $errors->first('image') }}</span>  @endif
                          <input type="hidden" name="old_image" value="{{ $data->image }}">
                        </div>

                        @if($data->featured == 1)
                        <div class="form-group">
                          <label for="exampleInputEmail1">Banner</label><br> 
                          @if($data->banner)
                          <img src="{{ asset('/upload/blog/'.$data->banner) }}" width="20%" >
                          @endif
                          <input type="file" name="banner" class="form-control">
                          <input type="hidden" name="old_banner" value="{{ $data->banner }}">
                        </div>
                        @endif

                        <div class="form-group @if($errors->has('date')) has-error  @endif">
                          <label for="exampleInputEmail1">Date</label>
                          <div class="input-group date">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" autocomplete="off" value="{{ $data->date }}" required="required" name="date" class="form-control pull-right" id="datepicker">
                          
                          </div>
                          @if($errors->has('date')) <span class="help-block">{{ $errors->first('date') }}</span>  @endif
                          
                        </div>
                        
                        <div class="form-group @if($errors->has('description')) has-error  @endif">
                          <label for="exampleInputEmail1">Description</label>
                          <textarea type="text" name="description" style="height: 400px;" required="required" class="form-control my-editor">{{ $data->description }}</textarea>
                          @if($errors->has('description')) <span class="help-block">{{ $errors->first('description') }}</span>  @endif
                        </div>
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    <!-- /.tab-pane -->
                    
                </div>
            </div>
        </div>
    </div>
@endsection
