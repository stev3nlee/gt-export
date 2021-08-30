@extends('layout')

@section('content')
    
    <div class="css-auth">
        <div class="banner" style="background: url('images/banner-auth.jpg') no-repeat center;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="box">
                            <div class="title mb20">Recover Password</div>
                            <div class="t-forgot">Please enter your new password below.</div><br />
                            <form action="{{ URL::to('/submit-recovery') }}" method="POST">
                            {!! csrf_field() !!}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="new-pass">New Password:</label>
                                            <input class="form-control" id="new-pass" name="password" type="password" />
                                            @if($errors->has('password')) <span class="help-block">{{ $errors->first('password') }}</span>  @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="confirm-pass">Confirm Password:</label>
                                            <input class="form-control" id="confirm-pass" name="password_confirmation" type="password" />
                                            @if($errors->has('password_confirmation')) <span class="help-block">{{ $errors->first('password_confirmation') }}</span>  @endif
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="code" value="{{ $unique }}">
                                <button class="hvr-button full100" type="submit">Submit</button>
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