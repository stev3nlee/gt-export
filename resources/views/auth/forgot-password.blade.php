@extends('layout')

@section('content')
    
    <div class="css-auth">
        <div class="banner" style="background: url('images/banner-auth.jpg') no-repeat center;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="box">
                            <div class="title mb20">Forgot Password</div>
                            <div class="t-forgot">Don't worry, you can get your new password by filling your existing email address. We will send you new one.</div> <br />
                            @if(Session::has('message_error_forgot'))
                                <p style="color:red;text-align:left;font-size:13px;">{{ Session::get('message_error_forgot') }}</p>
                            @endif
                            <form action="{{ URL::to('/submit-forgot') }}" method="POST" >
                            {!! csrf_field() !!}
                                <div class="row justify-content-center">
                                    <div class="col-md-8 col-lg-7">
                                        <div class="form-group">
                                            <label id="email">Email:</label>
                                            <input class="form-control" id="email" name="email" type="text" required="" />
                                        </div>
                                        <button class="hvr-button full100" type="submit">Submit</button>
                                        <div class="text-auth"><a href="{{ URL::to('/login') }}">Back</a></div>
                                    </div>
                                </div>
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