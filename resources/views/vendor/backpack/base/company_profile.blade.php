@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Company Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Company Profile</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    Update Company Profile
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
                        <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/company_profile/update') }}" enctype="multipart/form-data">
                          {!! csrf_field() !!}
                          
                          <div class="form-group @if($errors->has('image')) has-error @endif">
                            <label for="exampleInputEmail1">Image</label>
                            <input type="file" name="image" class="form-control">
                            @if(isset($data->image)) <img src="{{ asset('/upload/'.$data->image) }}" width="10%" /> @endif
                            <input type="hidden" name="old_image" value="@if(isset($data->image)) {{ $data->image }} @endif">
                          </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea name="description" class="form-control my-editor">@if(isset($data->description)) {{ $data->description }} @endif</textarea>
                          </div>

                          <!-- <div class="form-group">
                            <label for="exampleInputEmail1">Link</label>
                            <input name="link" class="form-control" value="@if(isset($data->link)){{ $data->link }}@endif">
                          </div> -->

                          <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        </div>
                      @foreach($language as $value)
                      <div class="tab-pane" id="{{ $value->id }}">
                        <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/company_profile/update_language') }}">
                          {!! csrf_field() !!}
                          <div class="form-group @if($errors->has('description')) has-error  @endif">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea type="text" name="description" class="form-control my-editor" >@foreach($data->languages as $lang) @if($lang->pivot->language_id == $value->id) {{ $lang ? $lang->pivot->description : '' }} @endif @endforeach </textarea>
                          </div>

                          <input type="hidden" name="language_id" value="{{ $value->id }}">
                          <input type="hidden" name="company_profile_id" value="{{ $data->id }}">
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
