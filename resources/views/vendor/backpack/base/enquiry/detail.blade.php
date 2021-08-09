@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Contact
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Contact</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    Detail Contact Us
                </div>

                <div class="box-body">
                      <div class="form-group @if($errors->has('email')) has-error  @endif">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="text" name="email" class="form-control" required="required" value="{{ $data->email }}" disabled>
                      </div>
                      <div class="form-group @if($errors->has('first_name')) has-error  @endif">
                        <label for="exampleInputEmail1">Phone</label>
                        <input type="text" name="first_name" class="form-control" required="required" value="{{ $data->phone }}" disabled>
                      </div>
                      <div class="form-group @if($errors->has('first_name')) has-error  @endif">
                        <label for="exampleInputEmail1">Name</label>
                        <input type="text" name="first_name" class="form-control" required="required" value="{{ $data->name }}" disabled>
                      </div>
                      <div class="form-group @if($errors->has('message')) has-error  @endif">
                        <label for="exampleInputEmail1">Message</label>
                        <textarea name="message" class="form-control" required="required" disabled>{{ $data->message }}</textarea>
                        @if($errors->has('message')) <span class="help-block">{{ $errors->first('message') }}</span>  @endif
                      </div>
                </div>
            </div>
        </div>
    </div>
@endsection
