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
                    Create Blog
                </div>

                <div class="box-body">
                    <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/blog/insert') }}" enctype="multipart/form-data" novalidate>
                      {!! csrf_field() !!}
                      <div class="form-group @if($errors->has('title')) has-error  @endif">
                        <label for="exampleInputEmail1">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required="required">
                        @if($errors->has('title')) <span class="help-block">{{ $errors->first('title') }}</span>  @endif
                      </div>
                
                      <div class="form-group @if($errors->has('image')) has-error  @endif">
                        <label for="exampleInputEmail1">Thumbnail</label>
                        <input type="file" name="image" class="form-control" required="required">
                        @if($errors->has('image')) <span class="help-block">{{ $errors->first('image') }}</span>  @endif
                      </div>
                      <div class="form-group @if($errors->has('date')) has-error  @endif">
                        <label for="exampleInputEmail1">Date</label>
                        <div class="input-group date">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" autocomplete="off" required="required" name="date" class="form-control pull-right" id="datepicker">
                          
                        </div>
                        @if($errors->has('date')) <span class="help-block">{{ $errors->first('date') }}</span>  @endif
                        
                      </div>

                      <div class="form-group @if($errors->has('description')) has-error  @endif">
                        <label for="exampleInputEmail1">Description</label>
                        <textarea type="text" style="height: 400px;" name="description" required="required" class="form-control my-editor">{{ old('description') }}</textarea>
                        @if($errors->has('description')) <span class="help-block">{{ $errors->first('description') }}</span>  @endif
                      </div>

                      <!-- <div class="form-group @if($errors->has('content')) has-error  @endif" id="content_blog">
                        <label for="exampleInputEmail1">Content</label>
                        <textarea name="content" style="height:500px" class="form-control my-editor" required="required"></textarea>
                        @if($errors->has('content')) <span class="help-block">{{ $errors->first('content') }}</span>  @endif
                      </div> -->

                  
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
@endsection