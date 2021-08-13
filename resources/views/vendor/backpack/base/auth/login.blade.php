@extends('vendor.backpack.base.layout_guest')

@section('content')
    <div class="row m-t-40">
        <div class="col-md-4 col-md-offset-4">
            <div class="text-center m-b-30">
                
                <img src="{{ asset('images/logo.png') }}" width="200">
            </div>
            <div class="box" style="border-radius: 25px;">
                <div class="box-body" style="border-radius: 25px;">
                    <h4 class="text-center">Welcome to Admin Panel</h4>

                    <form class="col-md-12 p-t-10" role="form" method="POST" action="{{ url(config('backpack.base.route_prefix').'/auth/login') }}">
                        {!! csrf_field() !!}
                              
                        <div class="form-group">
                            <!-- <label class="control-label">{{ config('backpack.base.authentication_column_name') }}</label> -->

                            <div>
                                <input type="text" class="form-control" placeholder="Email" name="username" autofocus>

                     
                            </div>
                        </div>

                        <div class="form-group">
                            <!-- <label class="control-label">{{ trans('vendor.backpack.base.base.password') }}</label> -->

                            <div>
                                <input type="password" class="form-control" placeholder="Password" name="password">

                       
                            </div>
                        </div>

                       <!--  <div class="form-group">
                            <div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> {{ trans('vendor.backpack.base.base.remember_me') }}
                                    </label>
                                </div>
                            </div>
                        </div> -->

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-block btn-primary" style="background-color: #003F5A;">
                                    Sign In
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
