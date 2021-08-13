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
                            <form>
                                <div class="bdr-upload">
                                    <div class="tbl tbl-upload">
                                        <div class="cell w120">
                                            <input type="hidden" name="_token" value="">
                                            <div class="img-profile no-profile">
                                                <img src="{{ asset('images/no-profile.png') }}" alt="" title=""/>   
                                            </div>
                                            <div class="img-profile" id="list"></div>
                                        </div>
                                        <div class="cell">
                                            <ul class="l-upload">
                                                <li>
                                                    <div class="css-upload btn-upload">
                                                        <input type="file" id="files" name="files[]">
                                                         <label for="files">Upload</label>
                                                    </div>
                                                </li>
                                                <li>
                                                    <button type="button" class="btn-remove">Remove</button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="fname">First Name:</label>
                                            <input class="form-control" id="fname" name="fname" type="text" required=""/>
                                        </div>     
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="lname">Last Name:</label>
                                            <input class="form-control" id="lname" name="lname" type="text" required=""/>
                                        </div>     
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="phone">Contact Number:</label>
                                            <input class="form-control only-number" id="phone" name="phone" type="text" required=""/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date of Birth:</label>
                                            <input class="form-control date" name="date-of-birth" type="text" required="" />
                                        </div>     
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="email">Email:</label>
                                            <input class="form-control" id="email" name="email" type="text" required="" />
                                        </div>     
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label id="password">Password:</label>
                                            <input class="form-control" id="password" name="password" type="password" required="" />
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
                                                <li>Sign in with Google</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 text-right resp-text-right">
                                            <div class="btn-link">
                                                <a href="#">Connect</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button class="hvr-button btnfull" type="button" data-toggle="modal" data-target="#modal-success">Save Changes</button>
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
        }
        document.getElementById('files').addEventListener('change', handleFileSelect, false);
    });
</script>
@endsection