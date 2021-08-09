@extends('vendor.backpack.base.layout')

@section('header')
    <section class="content-header">
      <h1>
        Member
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Member</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    Update Member
                </div>

                <div class="box-body">
                    <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/member/update') }}">
                      {!! csrf_field() !!}
                      <div class="form-group @if($errors->has('first_name')) has-error  @endif">
                        <label for="exampleInputEmail1">First Name</label>
                        <input type="text" name="first_name" value="{{ $data->first_name }}" class="form-control">
                        @if($errors->has('first_name')) <span class="help-block">{{ $errors->first('first_name') }}</span>  @endif
                      </div>
                      <div class="form-group @if($errors->has('last_name')) has-error  @endif">
                        <label for="exampleInputEmail1">Last Name</label>
                        <input type="text" name="last_name" value="{{ $data->last_name }}" class="form-control">
                        @if($errors->has('last_name')) <span class="help-block">{{ $errors->first('last_name') }}</span>  @endif
                      </div>
                      <div class="form-group @if($errors->has('email')) has-error  @endif">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" value="{{ $data->email }}" class="form-control">
                        @if($errors->has('email')) <span class="help-block">{{ $errors->first('email') }}</span>  @endif
                      </div>
                      <input type="hidden" name="id" value="{{ $data->id }}">
                  
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
