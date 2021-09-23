@extends('layout')

@section('content')
    
    <div class="css-auth">
        <div class="banner" style="background: url('images/banner-auth.jpg') no-repeat center;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="box">
                            <div class="title">Login</div>
                            <form method="post" action="{{ URL::to('/signin') }}">
                            @if(Session::has('message_login'))
                                <p style="color:red;text-align:left;font-size:13px;">The email and password are invalid.</p>
                            @endif

                            @if(Session::has('message_login_verified'))
                                <p style="color:red;text-align:left;font-size:13px;">Please verify your email before login. </p>
                            @endif
                            {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="email">Email:</label>
                                            <input class="form-control" id="email" name="email" type="text" required />
                                        </div>     
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="password">Password:</label>
                                            <input class="form-control" id="password" name="password" type="password" required />
                                        </div>     
                                    </div>
                                </div>
                                <!-- <button class="hvr-button full100" type="button" data-toggle="modal" data-target="#modal-success">Login</button> -->
                                <button class="hvr-button full100" type="submit">Login</button>
                                <div class="text-auth">New to this site? <a href="{{ URL::to('/register') }}">Sign Up</a>. Or you <a href="{{ URL::to('/forgot-password') }}">Forgot Password</a>?</div>
                                <div class="box-text">
                                    <div class="text">or login with</div>
                                </div>
                                <ul class="l-auth">
                                    <li>
                                        <a href="{{ url('google-login') }}">
                                            <ul class="link">
                                                <li class="mr25"><img src="{{ asset('images/google.png') }}" alt="" title=""/></li>
                                                <li>Google</li>
                                            </ul>
                                        </a>
                                    </li>
                                    <!-- <li>
                                        <a href="#">
                                            <ul class="link">
                                                <li class="mr35"><img src="{{ asset('images/facebook.png') }}" alt="" title=""/></li>
                                                <li>Facebook</li>
                                            </ul>
                                        </a>
                                    </li> -->
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