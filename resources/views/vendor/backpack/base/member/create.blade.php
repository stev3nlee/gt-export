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
                    Create Member
                </div>

                <div class="box-body">
                    <form role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/member/insert') }}">
                      {!! csrf_field() !!}
                      <div class="form-group @if($errors->has('first_name')) has-error  @endif">
                        <label for="exampleInputEmail1">First Name</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}">
                        @if($errors->has('first_name')) <span class="help-block">{{ $errors->first('first_name') }}</span>  @endif
                      </div>
                      <div class="form-group @if($errors->has('last_name')) has-error  @endif">
                        <label for="exampleInputEmail1">Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}">
                        @if($errors->has('last_name')) <span class="help-block">{{ $errors->first('last_name') }}</span>  @endif
                      </div>
                      <div class="form-group @if($errors->has('email')) has-error  @endif">
                        <label for="exampleInputEmail1">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                        @if($errors->has('email')) <span class="help-block">{{ $errors->first('email') }}</span>  @endif
                      </div>
                      <div class="form-group @if($errors->has('phone')) has-error  @endif">
                        <label for="exampleInputEmail1">Phone Number</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                        @if($errors->has('phone')) <span class="help-block">{{ $errors->first('phone') }}</span>  @endif
                      </div>
                      <div class="form-group @if($errors->has('dob')) has-error  @endif">
                        <label for="exampleInputEmail1">Date Of Birth</label>
                        <input type="date" name="dob" class="form-control">
                        @if($errors->has('dob')) <span class="help-block">{{ $errors->first('dob') }}</span>  @endif
                      </div>
                      <div class="form-group @if($errors->has('password')) has-error  @endif">
                        <label for="exampleInputEmail1">Password</label>
                        <input type="password" name="password" class="form-control" >
                        @if($errors->has('password')) <span class="help-block">{{ $errors->first('password') }}</span>  @endif
                      </div>
                      <div class="form-group @if($errors->has('password_confirmation')) has-error  @endif">
                        <label for="exampleInputEmail1">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                        @if($errors->has('password_confirmation')) <span class="help-block">{{ $errors->first('password_confirmation') }}</span>  @endif
                      </div>
                  
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
