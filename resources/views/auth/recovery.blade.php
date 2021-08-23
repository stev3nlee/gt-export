@extends('layout')

@section('content')
    
    <div class="css-auth">
        <div class="banner" style="background: url('images/banner-auth.jpg') no-repeat center;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="box">
                            <div class="title mb20">Recover Password</div>
                            <div class="t-forgot">Please enter the e-mail address you used to register an account below. An e-mail will be sent to you shortly to reset your password.</div>
                            <form>
                                <div class="row justify-content-center">
                                    <div class="col-md-8 col-lg-7">
                                        <div class="form-group">
                                            <label id="email">Email:</label>
                                            <input class="form-control" id="email" name="email" type="text" required="" />
                                        </div>
                                        <button class="hvr-button full100" type="button" data-toggle="modal" data-target="#modal-success">Submit</button>
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