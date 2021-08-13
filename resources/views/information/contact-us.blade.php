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
                                            <p>25 Ubi Avenue 3 #04-990 </p>
                                            <p>Paya Ubi Industrial Park</p>
                                            <p>Singapore 485603</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="item">
                                        <div class="t1">Opening Hours</div>
                                        <div class="t2 lh20 mb10">
                                            <p>Monday - Friday</p>
                                            <p><b>9:00 am - 7:00 pm</b></p>
                                        </div>
                                        <div class="t2 lh20">
                                            <p>Saturday</p>
                                            <p><b>9:00am - 4:00 pm</b></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="item">
                                        <div class="t1">Contact</div>
                                        <div class="t2">
                                            <a href="tel:67757998">6775 7998</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="item">
                                        <div class="t1">Email</div>
                                        <div class="t2">
                                            <a href="mailto:email@gtexport.com">email@gtexport.com</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-6">
                        <div class="title2">Contact Form</div>
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label id="name">Name:</label>
                                        <input class="form-control" id="name" name="name" type="text" required=""/>
                                    </div>     
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label id="email">Email:</label>
                                        <input class="form-control" id="email" name="email" type="text" required="" />
                                    </div>     
                                </div>
                            </div>
                            <div class="form-group">
                                <label id="phone">Phone:</label>
                                <input class="form-control only-number" id="phone" name="phone" type="text" required=""/>
                            </div> 
                            <div class="form-group">
                                <label id="message">Message:</label>
                                <textarea class="form-control" id="message" name="message" type="text" required=""></textarea>
                            </div>
                            <button class="hvr-button btnfull" type="button" data-toggle="modal" data-target="#modal-contact">Submit</button>
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