@extends('layout')

@section('content')
    <div class="css-contact">
        <div class="banner" style="background: url('images/banner-contact.jpg') no-repeat center;">
            <div class="tbl">
                <div class="cell">
                    <div class="container">
                        <div class="title">Contact Us</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="pad80">
                <div class="row">
                    <div class="col-md-5 col-lg-6">
                        <div class="mt70">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="item">
                                        <div class="t1">Address</div>
                                        <div class="t2">
                                            {!! $company_data->address !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="item">
                                        <div class="t1">Opening Hours</div>
                                        {!! $company_data->hours !!}
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="item">
                                        <div class="t1">Contact</div>
                                        <div class="t2">
                                            {!! $company_data->telephone !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="item">
                                        <div class="t1">Email</div>
                                        <div class="t2">
                                            {!! $company_data->email !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-6">
                        <div class="title2">Contact Form</div>
                        <form method="POST" action="{{ URL::to('/submit-contact') }}">
                         @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label id="name">Name:</label>
                                        <input class="form-control" id="name" name="name" type="text" />
                                        @if($errors->has('name')) <span class="help-block">{{ $errors->first('name') }}</span>  @endif
                                    </div>     
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label id="email">Email:</label>
                                        <input class="form-control" id="email" name="email" type="text" />
                                        @if($errors->has('email')) <span class="help-block">{{ $errors->first('email') }}</span>  @endif
                                    </div>     
                                </div>
                            </div>
                            <div class="form-group">
                                <label id="phone">Phone:</label>
                                <input class="form-control only-number" id="phone" name="phone" type="text" />
                                @if($errors->has('phone')) <span class="help-block">{{ $errors->first('phone') }}</span>  @endif
                            </div> 
                            <div class="form-group">
                                <label id="message">Message:</label>
                                <textarea class="form-control" id="message" name="message" type="text"></textarea>
                                @if($errors->has('message')) <span class="help-block">{{ $errors->first('message') }}</span>  @endif
                            </div>
                            <button class="hvr-button btnfull" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-contact" class="modal fade modal-global" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-pop" data-dismiss="modal">
                    <img src="{{ asset('images/close-pop.png') }}" alt="" title=""/>
                </div>
                <div class="pad-header">
                    <div class="img-pop">
                        <img src="{{ asset('images/logo.svg') }}" alt="" title=""/>
                    </div>
                    <div class="text-pop">You deserve quality & reliability.</div>
                </div>
                <div class="pad-bdy">
                    <div class="t-pop">
                        <div>Thank you for contacting us,</div>
                        <div>we will get back to you soon.</div>
                    </div>
                    <div class="btn-pop">
                        <a href="{{ URL::to('/') }}">
                            <button class="hvr-button" type="button">Back To Home</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function() {
		$('header').addClass('abs');

        $('.nav-contact').addClass('active');
	});
</script>
@endsection