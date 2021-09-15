@extends('layout')

@section('content')
    
    <div class="css-auth">
        <div class="banner" style="background: url('images/banner-auth.jpg') no-repeat center;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="box">
                            <div class="title">Register</div>
                            <form method="post" action="{{ URL::to('/submit-register') }}">
                            {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="fname">First Name:</label>
                                            <input class="form-control" id="fname" name="first_name" type="text"/>
                                            @if($errors->has('first_name')) <span class="help-block">{{ $errors->first('first_name') }}</span>  @endif
                                        </div>     
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="lname">Last Name:</label>
                                            <input class="form-control" id="lname" name="last_name" type="text"/>
                                            @if($errors->has('last_name')) <span class="help-block">{{ $errors->first('last_name') }}</span>  @endif
                                        </div>     
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="phone">Contact Number:</label>
                                            <input class="form-control only-number" id="phone" name="contact_number" type="text"/>
                                            @if($errors->has('contact_number')) <span class="help-block">{{ $errors->first('contact_number') }}</span>  @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="date">Date of Birth:</label>
                                            <input class="form-control date" name="date_of_birth" autocomplete="off" type="text" readonly/>
                                            @if($errors->has('date_of_birth')) <span class="help-block">{{ $errors->first('date_of_birth') }}</span>  @endif
                                        </div>     
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="email">Email:</label>
                                            <input class="form-control" id="email" name="email" type="text"/>
                                            @if($errors->has('email')) <span class="help-block">{{ $errors->first('email') }}</span>  @endif
                                        </div>     
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="pass1">Password:</label>
                                            <input class="form-control" id="pass1" name="password" type="password"/>
                                            @if($errors->has('password')) <span class="help-block">{{ $errors->first('password') }}</span>  @endif
                                        </div>     
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="pass2">Re-enter Password:</label>
                                            <input class="form-control" id="pass2" name="password_confirmation" type="password"/>
                                            @if($errors->has('password_confirmation')) <span class="help-block">{{ $errors->first('password_confirmation') }}</span>  @endif
                                        </div>
                                    </div>
                                </div>
                                <button class="hvr-button full100" type="submit">Sign Up</button>
                                <div class="box-text mt40">
                                    <div class="text">or signup with</div>
                                </div>
                                <ul class="l-auth">
                                    <li>
                                        <a href="#">
                                            <ul class="link">
                                                <li class="mr25"><img src="{{ asset('images/google.png') }}" alt="" title=""/></li>
                                                <li>Google</li>
                                            </ul>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <ul class="link">
                                                <li class="mr35"><img src="{{ asset('images/facebook.png') }}" alt="" title=""/></li>
                                                <li>Facebook</li>
                                            </ul>
                                        </a>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function() {

	});
</script>
@endsection