@extends('layout')

@section('content')
    <div class="pad-content pt30">
        <div class="css-account">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="left-account">
                            @include('member.menu')
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="right-account">
                            <div class="title">Personal Information</div>
                            <div class="t1">Avatar</div>
                                <div class="bdr-upload">
                                    <div class="tbl tbl-upload">
                                        <div class="cell w120">
                                            <input type="hidden" name="_token" value="">
                                            <div class="img-profile no-profile">
                                                @if($member->image)
                                                    <img src="{{ asset('upload/profile/'.$member->image) }}" alt="" title=""/>
                                                @else
                                                    <img src="{{ asset('images/no-profile.png') }}" alt="" title=""/>
                                                @endif   
                                            </div>
                                            <div class="img-profile" id="list"></div>
                                        </div>
                                        <div class="cell">
                                            <form method="POST" action="{{ URL::to('/upload-profile') }}" id="uploadProfile" enctype="multipart/form-data">
                                            @csrf
                                            <ul class="l-upload">
                                                <li>
                                                    <div class="css-upload btn-upload">
                                                        <input type="file" id="files" accept="image/*"  name="file">
                                                        @if($errors->has('file')) <span class="help-block">{{ $errors->first('file') }}</span>  @endif
                                                         <label for="files">Upload</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <a type="button" class="btn-remove" href="{{ URL::to('/remove-photo') }}">Remove</a>
                                                </li>
                                            </ul>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <form method="POST" action="{{ URL::to('/update-account') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="fname">First Name:</label>
                                            <input class="form-control" id="fname" name="first_name" type="text" value="{{ $member->first_name }}"/>
                                            @if($errors->has('first_name')) <span class="help-block">{{ $errors->first('first_name') }}</span>  @endif
                                        </div>     
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="lname">Last Name:</label>
                                            <input class="form-control" id="lname" name="last_name" type="text" value="{{ $member->last_name }}"/>
                                            @if($errors->has('member')) <span class="help-block">{{ $errors->first('member') }}</span>  @endif
                                        </div>     
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="phone">Contact Number:</label>
                                            <input class="form-control only-number" id="phone" name="phone" type="text" value="{{ $member->phone }}"/>
                                            @if($errors->has('phone')) <span class="help-block">{{ $errors->first('phone') }}</span>  @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date of Birth:</label>
                                            <input class="form-control date" name="dob" type="text" value="{{ $member->dob }}" readonly="" />
                                            @if($errors->has('dob')) <span class="help-block">{{ $errors->first('dob') }}</span>  @endif
                                        </div>     
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="email">Email:</label>
                                            <input class="form-control" id="email" name="email" type="text" @if($member->email) readonly @endif value="{{ $member->email }}" />
                                            @if($errors->has('email')) <span class="help-block">{{ $errors->first('email') }}</span>  @endif
                                        </div>     
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="password">Password:</label>
                                            <input class="form-control" id="password" name="password" type="password" />
                                            @if($errors->has('password')) <span class="help-block">{{ $errors->first('password') }}</span>  @endif
                                        </div>     
                                    </div>
                                </div>
                                <div class="link-account">
                                    <div class="t3">Linked Accounts</div>
                                    <div class="t4">
                                        <p>We use this to let you sign in and populate your profile information.</p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <ul class="link">
                                                <li><img src="{{ asset('images/google.png') }}" alt="" title=""/></li>
                                                @if($member->google_id == null) <li>Sign in with Google</li> @else <li>Your account is linked</li> @endif
                                            </ul>
                                        </div>
                                        @if($member->google_id == null)
                                        <div class="col-md-6 text-right resp-text-right">
                                            <div class="btn-link">
                                                <a href="{{ url('google-login') }}">Connect</a>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button class="hvr-button btnfull" type="submit">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<style>
</style>
@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function() {
		$('.nav-info').addClass('active');

        $('header').addClass('account');

        $('.btn-remove').click(function(event) {
            $('#list div').remove();
            $('.no-profile').show();
            $('.btn-upload').show();
        });

        function handleFileSelect(evt) {
            var files = evt.target.files;
            for (var i = 0, f; f = files[i]; i++) {
                if (!f.type.match('image.*')) {
                    continue;
                }
                var reader = new FileReader();

                reader.onload = (function(theFile) {
                    return function(e) {
                        var span = document.createElement('div');
                            span.innerHTML = ['<img src="', e.target.result, '" title="', escape(theFile.name), '"  accept="image/x-png,image/gif,image/jpeg">'].join('');
                            document.getElementById('list').insertBefore(span, null);
                        };
                })(f);
                reader.readAsDataURL(f);
            }
            $('.no-profile').hide();
            $('.btn-upload').hide();
            $('#uploadProfile').submit();
        }
        document.getElementById('files').addEventListener('change', handleFileSelect, false);
    });
</script>
@endsection