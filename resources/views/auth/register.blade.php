@extends('layout')

@section('content')
    
    <div class="css-auth">
        <div class="banner" style="background: url('images/banner-auth.jpg') no-repeat center;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="box">
                            <div class="title">Register</div>
                            <form>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="fname">First Name:</label>
                                            <input class="form-control" id="fname" name="fname" type="text" required="" value="Anthony"/>
                                        </div>     
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="lname">Last Name:</label>
                                            <input class="form-control" id="lname" name="lname" type="text" required="" value="Lee"/>
                                        </div>     
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="phone">Contact Number:</label>
                                            <input class="form-control only-number" id="phone" name="phone" type="text" required="" value="+65 9887 0665"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="date">Date of Birth:</label>
                                            <input class="form-control date" name="date-of-birth" type="text" required=""/>
                                        </div>     
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="email">Email:</label>
                                            <input class="form-control" id="email" name="email" type="text" required="" value="anthony@gmail.com"/>
                                        </div>     
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="pass1">Password:</label>
                                            <input class="form-control" id="pass1" name="pass1" type="password" required="" value=""/>
                                        </div>     
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="pass2">Re-enter Password:</label>
                                            <input class="form-control" id="pass2" name="pass2" type="password" required="" value=""/>
                                        </div>
                                    </div>
                                </div>
                                <button class="hvr-button full100" type="button" data-toggle="modal" data-target="#modal-success">Sign Up</button>
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