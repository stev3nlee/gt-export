@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Recipe Category
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Recipe Category</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    Update Recipe Category
                </div>

                <div class="box-body">
                  <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#English" data-toggle="tab">English</a></li>
                      @foreach($language as $list)
                      <li><a href="#{{ $list->id }}" data-toggle="tab">{{ $list->name }}</a></li>
                      @endforeach
                    </ul>
                    <div class="tab-content">
                      <div class="tab-pane active" id="English">
                        <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/recipe_category/update') }}" enctype="multipart/form-data">
                          {!! csrf_field() !!}
                          <div class="form-group @if($errors->has('name')) has-error  @endif">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" value="{{ $data->name }}" class="form-control">
                            @if($errors->has('name')) <span class="help-block">{{ $errors->first('name') }}</span>  @endif
                          </div>

                          
                          <input type="hidden" name="id" value="{{ $data->id }}">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                      </div>
                      @foreach($language as $value)
                      <div class="tab-pane" id="{{ $value->id }}">
                        <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/recipe_category/update_language') }}">
                          {!! csrf_field() !!}
                          <div class="form-group @if($errors->has('name')) has-error  @endif">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control" @foreach($data->languages as $lang) @if($lang->pivot->language_id == $value->id) value="{{ $lang ? $lang->pivot->name : '' }}" @endif @endforeach>
                          </div>

                          <input type="hidden" name="language_id" value="{{ $value->id }}">
                          <input type="hidden" name="recipe_category_id" value="{{ $data->id }}">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
