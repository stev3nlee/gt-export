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
                        <input type="text" name="last_name" class="form-control" value="{{ $data->last_name }}">
                        @if($errors->has('last_name')) <span class="help-block">{{ $errors->first('last_name') }}</span>  @endif
                      </div>
                      <div class="form-group @if($errors->has('email')) has-error  @endif">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" value="{{ $data->email }}" class="form-control">
                        @if($errors->has('email')) <span class="help-block">{{ $errors->first('email') }}</span>  @endif
                      </div>

                      <div class="form-group @if($errors->has('phone')) has-error  @endif">
                        <label for="exampleInputEmail1">Phone Number</label>
                        <input type="text" name="phone" value="{{ $data->phone }}" class="form-control">
                        @if($errors->has('phone')) <span class="help-block">{{ $errors->first('phone') }}</span>  @endif
                      </div>

                      <div class="form-group @if($errors->has('dob')) has-error  @endif">
                        <label for="exampleInputEmail1">Date Of Birth</label>
                        <input type="date" name="dob" value="{{ $data->dob }}" class="form-control">
                        @if($errors->has('dob')) <span class="help-block">{{ $errors->first('dob') }}</span>  @endif
                      </div>
                      
                      <div class="form-group @if($errors->has('password')) has-error  @endif">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" name="password" placeholder="leave empty if not want to change password" class="form-control">
                        @if($errors->has('password')) <span class="help-block">{{ $errors->first('password') }}</span>  @endif
                      </div>
                      <input type="hidden" name="id" value="{{ $data->id }}">
                  
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
