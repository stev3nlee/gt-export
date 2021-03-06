<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0"/>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <title>GT EXPORT</title>
    <!--favicon-->
    <link rel="shortcut icon" type="image/ico" href="{{ asset('images/favicon.ico') }}"/>
    <!-- <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-icon-180x180.png?v.1') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png?v.1') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png?v.1') }}"> -->
    
    <!-- CSS -->
    @yield('css')
    <link href="{{ asset('js/fancybox/jquery.fancybox.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('js/jquery-ui/jquery-ui.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/front.css') }}" rel="stylesheet"/>
    <style>
      .help-block{
        color: #dd4b39;
      }
      .required{
        color: #dd4b39;
      }
    </style>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<section id="main-page">
    <div class="bg-dark-menu"></div>
    <div class="bg-dark-cart"></div>
    <header>
        <div class="box-search">
            <form action="{{ URL::to('/product-listing') }}">
                <input class="form-control" type="text" name="search" placeholder="Search for Used Car" />
                <button type="submit"><img src="{{ asset('images/search2.png') }}" alt="" title=""/></button>
            </form>
        </div>
        <div class="container pos-rel">
            <div class="row row5">
                <div class="col-6 offset-3 col-md-4 offset-md-4 text-center my-auto">
                    <div class="logo">
                        <a href="{{ URL::to('/') }}">
                            <img src="{{ asset('images/logo.svg') }}" alt="" title=""/>
                        </a>
                    </div>
                </div>
                <div class="col-3 col-md-4 my-auto text-right">
                    <div class="hide-md">
                        <div class="search">
                            <form action="{{ URL::to('/product-listing') }}">
                                <input class="form-control" type="text" name="search" placeholder="Search for Used Car" />
                                <button type="submit"><img src="{{ asset('images/search2.png') }}" alt="" title=""/></button>
                            </form>
                        </div>
                        <!-- NO ACCOUNT-->
                        @if(session()->has('email'))
                        <div class="link-account" class="link-account">
                            <a href="{{ URL::to('/personal-info') }}">
                                <div class="tbl">
                                    <div class="cell img">
                                    @if(isset($member_detail->image))
                                        <img src="{{ asset('upload/profile/'.$member_detail->image) }}" alt="" title=""/>
                                    @else
                                        <img src="{{ asset('images/no-profile.png') }}" alt="" title=""/>
                                    @endif
                                    </div>
                                    <div class="cell nm">{{ session()->get('first_name') }}</div>
                                </div>
                            </a>
                        </div>
                        @else
                        <div class="link">
                            <a href="{{ url('login') }}" >
                                <button class="hvr-button">Login / Sign Up</button>
                            </a>
                        </div>
                        @endif
                    </div>
                    <div class="show-md">
                        <ul class="right-menu">
                            <li>
                                <a class="menu-resp-dropdown-toggle">
                                    <img src="{{ asset('images/menu.png') }}" alt="" title=""/>
                                </a>
                            </li>
                            <li>
                                <div class="click-search"><img src="{{ asset('images/search2.png') }}" alt="" title=""/></div>
                            </li>
                            <li>
                                <div class="login menu-login">
                                    <a class="click-login">
                                        <img src="{{ asset('images/new-login.svg') }}" alt="" title=""/>
                                    </a>
                                </div>
                                <div class="login menu-account">
                                    <a href="{{ URL::to('/personal-info') }}">
                                        <img src="{{ asset('images/new-account.svg') }}" alt="" title=""/>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-menu">
            <div class="container">
                <ul class="l-menu">
                    <li class="dropdown-item-1"><a class="nav-about" href="{{ URL::to('/about-us') }}">About Us</a></li>
                    <li class="dropdown-item-2"><a class="nav-product" href="{{ URL::to('/product-listing') }}">Stocklist</a></li>
                    <!--<li class="dropdown-item-3">
                        <a class="nav-regulation" href="{{ URL::to('/regulation-details') }}">
                            <div>Destination Country</div>
                            <div>Regulation Details</div>
                        </a>
                    </li>
                    -->
                    <li class="dropdown-item-4"><a class="nav-procurement" href="{{ URL::to('/procurement-flow') }}"><div>Export Procedure</div></a></li>
                    <li class="dropdown-item-6"><a class="nav-payment" href="{{ URL::to('/payment') }}">Payment</a></li>
                    <li class="dropdown-item-7"><a class="nav-faq" href="{{ URL::to('/faq') }}">FAQ</a></li>
                    <li class="dropdown-item-8"><a class="nav-contact" href="{{ URL::to('/contact-us') }}">Contact Us</a></li>
                </ul>
            </div>
        </div>
    </header>

    <div id="main">
        @yield('content')
    </div>

    <footer id="footer">
        <div class="container">
            <ul class="l-footer">
                <li>
                    <img src="{{ asset('images/logo-footer.png') }}" alt="" title=""/>
                </li>
                <li><a href="{{ URL::to('/disclaimers') }}">Disclaimers</a></li>
                <li><a href="{{ URL::to('/privacy') }}">Privacy</a></li>
            </ul>
            <ul class="l-soc hide-desktop">
                <li><a href="{{ $company_data->instagram }}" target="_blank" rel="noreferrer noopener"><i class="fab fa-instagram"></i></a></li>
                <li><a href="{{ $company_data->facebook }}" target="_blank" rel="noreferrer noopener"><i class="fab fa-facebook-square"></i></a></li>
                <li><a href="{{ $company_data->linkedin }}" target="_blank" rel="noreferrer noopener"><i class="fab fa-linkedin"></i></a></li>
            </ul>
            <div class="row">
                <div class="col-sm-6 my-auto order-2 order-md-1">
                    <div class="cp">All Rights Reserved <?php echo date('Y'); ?></div>
                </div>
                <div class="col-sm-6 my-auto order-1 order-md-2">
                    <ul class="l-soc hide-mobile">
                        <li><a href="{{ $company_data->instagram }}" target="_blank" rel="noreferrer noopener"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="{{ $company_data->facebook }}" target="_blank" rel="noreferrer noopener"><i class="fab fa-facebook-square"></i></a></li>
                        <li><a href="{{ $company_data->linkedin }}" target="_blank" rel="noreferrer noopener"><i class="fab fa-linkedin"></i></a></li>
                    </ul>
                </div>
            </div>
            
        </div>
    </footer>
</section>

    <div id="menu">
        <div class="close-menu">
            <img src="{{asset('images/close-menu.png')}}" title="" alt=""/>
        </div>
        <div class="l-menu">
            <ul>
                <li><a class="nav-about" href="{{ URL::to('/about-us') }}">About Us</a></li>
                <li><a class="nav-product" href="{{ URL::to('/product-listing') }}">Stocklist</a></li>
                <!--
                <li>
                    <a class="nav-regulation" href="{{ URL::to('/regulation-details') }}">Destination Country Regulation Details</a>
                </li>
                -->
                <li><a class="nav-procurement" href="{{ URL::to('/procurement-flow') }}">Export Procedure</a></li>
                <li><a class="nav-payment" href="{{ URL::to('/payment') }}">Payment</a></li>
                <li><a class="nav-faq" href="{{ URL::to('/faq') }}">FAQ</a></li>
                <li><a class="nav-contact" href="{{ URL::to('/contact-us') }}">Contact Us</a></li>
            </ul>
        </div>
    </div>

    <div id="modal-submit-quote" class="modal fade modal-global" role="dialog">
        <div class="modal-dialog">
            <form action="{{ url('submit-quote') }}" method="post" id="submit-quote-member">
            @csrf
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
                    <div class="t2-pop">Let???s get started!</div>
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="bdy-pop">
                                <p>Do you want to submit quote?</p>
                            </div>
                        </div>
                    </div>
                    <ul class="l-pop">
                        <li class="active"><a>Yes</a></li>
                        <li class="click-quote-no"><a>No</a></li>
                    </ul>
                    <center>
                    <div class="col-md-6">
                                <div class="form-group">
                                    <label id="country">Country:</label>
                                    <select class="form-control" id="select-country-member" name="country" required >
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->country }}</option>
                                        @endforeach
                                        <option value="other">Other</option>
                                    </select>
                                </div>     
                            </div>

                            <div class="col-md-6">
                                <div class="form-group" id="div-port-member" style="display: none;">
                                    <label id="country">Port:</label>
                                    <select class="form-control" id="select-port-member" name="port">
                                        <option value="">Select Port</option>
                                    </select>
                                </div>     
                            </div>
                        <div class="g-recaptcha" data-sitekey="6LfKdqodAAAAAFi57MDeRi_YckjKphEz9ggJ7FgC"></div><br>
                    </center>
                    <input type="hidden" name="product" id="product-quote">
                    <div class="btn-pop">
                        <button class="hvr-button" type="submit">Submit Quote</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>

    <div id="modal-login" class="modal fade modal-global" role="dialog">
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
                    <div class="t2-pop">Let???s get started!</div>
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="bdy-pop">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sit massa eget sit risus non non in quis faucibus.</p>
                            </div>
                        </div>
                    </div>
                    <ul class="l-pop">
                        <li class="active have-account"><a>I have an account</a></li>
                        <li class="dont-have-account"><a>I do not have an account</a></li>
                        <li class="click-register"><a>Continue as a guest</a></li>
                    </ul>
                    <form action="{{ URL::to('/proceedLogin') }}" method="POST">
                    @csrf
                    <div class="btn-pop" id="button-login">
                         <input type="hidden" name="product_login" id="product-quote-login">

                            <button class="hvr-button" type="submit">Proceed to Login</button>

                    </div>
                    </form>
                    <div class="btn-pop" id="button-register" style="display: none;">
                        <a href="{{ URL::to('/register') }}">
                            <button class="hvr-button" type="button">Proceed to Register</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php /* ?>
    <div id="modal-register" class="modal fade modal-global" role="dialog">
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
                    <div class="t2-pop">Let???s get started!</div>
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="bdy-pop">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sit massa eget sit risus non non in quis faucibus.</p>
                            </div>
                        </div>
                    </div>
                    <ul class="l-pop">
                        <li class="click-login" data-toggle="modal"><a>I have an account</a></li>
                        <li class="active"><a>I do not have an account</a></li>
                    </ul>
                    <form action="{{ URL::to('/register') }}">
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
                                    <input class="form-control date" name="date-of-birth-register" type="text" required="" readonly="" />
                                </div>     
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="email">Email:</label>
                                    <input class="form-control" id="email" name="email" type="text" required="" />
                                </div>     
                            </div>
                        </div>
                        <div class="btn-pop mt30">
                            <button class="hvr-button" type="submit">Register Now</button>
                        </div>
                    </form>                    
                    <div class="or">or</div>
                    <div class="link-pop">
                        <a class="click-guest">Proceed as guest</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php */ ?>

    <div id="modal-guest" class="modal fade modal-global" role="dialog">
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
                    <div class="t2-pop">Let???s get started!</div>
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="bdy-pop">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sit massa eget sit risus non non in quis faucibus.</p>
                            </div>
                        </div>
                    </div>
                    <ul class="l-pop">
                        <li class="click-login" data-toggle="modal"><a>I have an account</a></li>
                        <li class="active"><a>Continue as a guest</a></li>
                    </ul>
                    <form action="{{ url('submit-quote-guest') }}" method="post" id="submit-quote-guest">
                    @csrf
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
                                    <input class="form-control date" name="dob_guest" readonly="" type="text" required="" value=""/>
                                </div>     
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="email">Email:</label>
                                    <input class="form-control" id="email" name="email" type="email" required="" />
                                </div>     
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label id="country">Country:</label>
                                    <select class="form-control" id="select-country" name="country" required >
                                        <option value="">Select Country</option>
                                        @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->country }}</option>
                                        @endforeach
                                        <option value="other">Other</option>
                                    </select>
                                </div>     
                            </div>

                            <div class="col-md-6">
                                <div class="form-group" id="div-port" style="display: none;">
                                    <label id="country">Port:</label>
                                    <select class="form-control" id="select-port" name="port">
                                        <option value="">Select Port</option>
                                    </select>
                                </div>     
                            </div>
                            
                            <input type="hidden" name="product" id="product-quote-guest">
                        </div>
                        <div class="btn-pop mt30">
                            <center>
                                <div class="g-recaptcha" data-sitekey="6LfKdqodAAAAAFi57MDeRi_YckjKphEz9ggJ7FgC"></div>
                                @if($errors->has('g-recaptcha-response-1')) <div class="alert alert-danger alert-block">{{ $errors->first('g-recaptcha-response-1') }}</div>  @endif<br>
                            </center>
                            <button class="hvr-button" type="submit">Proceed as guest</button>
                        </div>
                    </form>                    
                    <div class="or">or</div>
                    <div class="link-pop">
                        <a href="{{ url('register') }}" >Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-success" class="modal fade modal-global" role="dialog">
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
                    <div class="img-success" id="success-icon">
                        <img src="{{ asset('images/success.png') }}" alt="" title=""/>
                    </div>
                    <div class="t-pop2">
                        <div id="message-success">Thank you for your interest! We will send your quotation to your registered email address within x working days.</div>
                    </div>
                    <div class="btn-pop">
                        <a href="{{ URL::to('/') }}">
                            <button class="hvr-button" type="button">Back to Stocklist</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="box-wa">
        <a>
            <ul class="l-wa">
                <li class="bg-chat">Need Help? <span class="bold">Chat with us</span></li>
                <li class="bg"><i class="fab fa-whatsapp"></i></li>
            </ul>
        </a>
    </div>
    <div class="box-wa2">
        <ul class="l-hdr">
            <li><i class="fab fa-whatsapp"></i></li>
            <li class="text">Chat with Us!</li>
        </ul>
        <div class="pad-wa">
            <div class="t1">The team typically replies in a few minutes.</div>
            <div class="link-wa">
                <a href="https://wa.me/6596178716" target="_blank" rel="noreferrer noopener"> 
                    <ul class="l-bdy">
                        <li><i class="fab fa-whatsapp"></i></li>
                        <li class="text">GT EXPORT</li>
                    </ul>
                </a>
            </div>
        </div>
        <div class="abs-close">
            <i class="fas fa-times"></i>
        </div>
    </div>

<script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery-ui/jquery-ui.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.ui.touch-punch.min.js') }}"></script>

<!-- JS -->
@yield('js')
<script type="text/javascript">
    $(window).scroll(function () {
        if (
            $(window).scrollTop() + $(window).height() <
            $(document).height() - $("#footer").height()
        ) {
            $(".box-wa").css("bottom", "30px");
        }
        if (
            $(window).scrollTop() + $(window).height() >
            $(document).height() - $("#footer").height()
        ) {
            $(".box-wa").css("bottom", "44px");
        }
    });
    function scrollAll() {
        a = $(window).scrollTop();
        if (a > 200) {
            $('.box-wa').fadeIn();
        } else {
            $('.box-wa').fadeOut();
        }
    }
    $(document).ready(function() {
        scrollAll();

        $(window).scroll(function() {
            scrollAll();
        });

        $('.box-wa').click(function(event) {
            $(this).addClass('active');
            $('.box-wa2').addClass('active');
        });

        $('.abs-close').click(function(event) {
            $('.box-wa2').removeClass('active');
            $('.box-wa').removeClass('active');
        });

        $(".only-number").keydown(function (e) {
            if (
                $.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                (e.keyCode == 65 && (e.ctrlKey === true || e.metaKey === true)) ||
                (e.keyCode == 67 && (e.ctrlKey === true || e.metaKey === true)) ||
                (e.keyCode == 88 && (e.ctrlKey === true || e.metaKey === true)) ||
                (e.keyCode >= 35 && e.keyCode <= 39)
            ) {
                return;
            }
            if (
                (e.shiftKey || e.keyCode < 48 || e.keyCode > 57) &&
                (e.keyCode < 96 || e.keyCode > 105)
            ) {
                e.preventDefault();
            }
        });
        
        $('.click-register').click(function() {
            $('#modal-login').modal('hide');
            $('#modal-guest').modal('toggle');
            //$('#modal-register').modal('toggle');
            $('body').addClass('no-scroll');
            $('.modal').addClass('scroll');
        });

        $('.click-login').click(function() {
            $('#modal-login').modal('toggle');
            $('#modal-register').modal('hide');
            $('#modal-guest').modal('hide');
            $('body').addClass('no-scroll');
            $('.modal').addClass('scroll');
        });

        $('.click-guest').click(function() {
            $('#modal-guest').modal('toggle');
            $('#modal-login').modal('hide');
            $('#modal-register').modal('hide');
            $('body').addClass('no-scroll');
            $('.modal').addClass('scroll');
        });

        $('.click-success').click(function() {
            $('#modal-guest').modal('hide');
            $('#modal-login').modal('hide');
            $('#modal-register').modal('hide');
        });

        $('.click-quote-no').click(function() {
            $('#modal-submit-quote').modal('hide');
            $('body').addClass('scroll');
            $('.modal').addClass('scroll');
        });

        $('.click-submit-quote').click(function() {
            product_quote = $(this).data('product'); 
            $('#modal-submit-quote').modal('toggle');
            $('#modal-register').modal('hide');
            $('#modal-guest').modal('hide');
            $('#product-quote').val(product_quote);
            $('body').addClass('scroll');
            $('.modal').addClass('scroll');
        });

        $('.click-submit-quote-guest').click(function() {
            product_quote = $(this).data('product'); 
            $('#modal-login').modal('toggle');
            $('#modal-register').modal('hide');
            $('#modal-guest').modal('hide');
            $('body').addClass('scroll');
            $('.modal').addClass('scroll');
            $('#product-quote-guest').val(product_quote);
            $('#product-quote-login').val(product_quote);
        });

        $('.close-pop').click(function(event) {
            $('body').removeClass('no-scroll');
            $('.modal').removeClass('scroll');
        });


        //$('.menu-dropdown-toggle').click(function(event) {
        //    $('.bg-menu').toggleClass('open');
        //});

        $('.dont-have-account').click(function() {
            $('#button-login').hide();
            $('#button-register').show();
            $('.dont-have-account').addClass('active');
            $('.have-account').removeClass('active');
        });

        $('.have-account').click(function() {
            $('#button-login').show();
            $('#button-register').hide();
            $('.dont-have-account').removeClass('active');
            $('.have-account').addClass('active');
        });

        let start = new Date();
        start.setFullYear(start.getFullYear() - 100);
        let end = new Date();
        end.setFullYear(end.getFullYear() - 18);

        $(".date").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'dd MM yy',
            // minDate: start,
            // maxDate: end + 1,
            yearRange: start.getFullYear() + ':' + end.getFullYear(),
            onClose: function(dateText, inst) { 
                var startDate = new Date(dateText);
                var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(year, month, inst.selectedDay));
            }
        });

        // $( ".date" ).datepicker({    
        //     changeMonth: true,
        //     changeYear: true,
        //     yearRange: '1960:2003',
        //     onClose: function(dateText, inst) { 
        //         var startDate = new Date(dateText);
        //         var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
        //         var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
        //         $(this).datepicker('setDate', new Date(year, month, inst.selectedDay));
        //     }
        // });

        $(".menu-resp-dropdown-toggle").click(function(a) {
        a.preventDefault();
            $("body").toggleClass("offcanvas-menu-open");
            $(".bg-dark-menu").show();
            $(".bg-dark-menu").animate({
                opacity: .7
            });
        });

        $("html").click(function(a) {
            if (!$(a.target).parents().is(".menu-resp-dropdown-toggle") && !$(a.target).is("#menu") && !$(a.target).is(".close-menu") && !$(a.target).parents().is("#menu")) {
                $("body").removeClass("offcanvas-menu-open");
                $(".bg-dark-menu").hide();
                $(".bg-dark-menu").animate({
                    opacity: 0
                });
            }
        });

        $(".close-menu").click(function(a) {
            $("body").removeClass("offcanvas-menu-open");
            $(".bg-dark-menu").hide();
            $(".bg-dark-menu").animate({
                opacity: 0
            });
        });

        $(document).keyup(function(a) {
            if (27 == a.keyCode) {
                $("body").removeClass("offcanvas-menu-open");
                $(".bg-dark-menu").hide();
                $(".bg-dark-menu").animate({
                    opacity: 0
                });
                $('body').removeClass('no-scroll');

                $('#modal-guest').modal('hide');
                $('#modal-login').modal('hide');
                $('#modal-register').modal('hide');
            }
        });

        $('.click-search').click(function(event) {
            $('.box-search').addClass('open');
            $('#main-page').addClass('open');
        });

        $("html").click(function(a) {
            if (!$(a.target).parents().is(".box-search") && !$(a.target).is(".close-menu") && !$(a.target).parents().is(".click-search")) {
                $('.box-search').removeClass('open');
                $('#main-page').removeClass('open');
            }
        });
    }); 
  @if(Session::has('register_success'))
  $('#message-success').html('{{Session::get('register_success')}}');
  $('#modal-success').modal('show');
  @endif
  @if(Session::has('register_failed'))
  $('#message-success').html('{{Session::get('register_failed')}}');
  $('#success-icon').html('');
  $('#modal-success').modal('show');
  @endif
  @if(Session::has('verify_success'))
  $('#message-success').html('{{Session::get('verify_success')}}');
  $('#modal-success').modal('show');
  @endif
  @if(Session::has('forgot_success'))
  $('#message-success').html('{{Session::get('forgot_success')}}');
  $('#modal-success').modal('show');
  @endif
  @if(Session::has('recovery_success'))
  $('#message-success').html('{{Session::get('recovery_success')}}');
  $('#modal-success').modal('show');
  @endif
  @if(Session::has('contact_success'))
  $('#modal-contact').modal('show');
  @endif
  @if(Session::has('quotation_success'))
  $('#modal-success').modal('show');
  @endif

  $('#submit-quote-member').submit(function () {
        let recaptcha = $("#g-recaptcha-response").val();
        if (recaptcha === "") {
            event.preventDefault();
            alert('Please fill recaptcha');
             return false;
        }else{
            this.submit();
        }
  });

  $('#submit-quote-guest').submit(function () {
        let recaptcha = $("#g-recaptcha-response-1").val();
        if (recaptcha === "") {
            event.preventDefault();
            alert('Please fill recaptcha');
             return false;
        }else{
            this.submit();
        }
  });

  $('#select-country').on('change', function() {
                var countryID = $(this).val();
                if(countryID != 'other') {
                    $.ajax({
                        url: '{{ url("getPort") }}/'+countryID,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('#div-port').show();
                            $('#select-port').attr('required', 'required');
                            $('#select-port').empty();
                            $('#select-port').append('<option value="">Select Port</option>');
                            $.each(data, function(key, value) {
                                $('#select-port').append('<option value="'+ value.id +'">'+ value.port +'</option>');
                            });
                        }
                    });
                }else{
                    $('#select-port').removeAttr('required');
                    $('#div-port').hide();
                }
        });

    $('#select-country-member').on('change', function() {
                var countryID = $(this).val();
                if(countryID != 'other') {
                    $.ajax({
                        url: '{{ url("getPort") }}/'+countryID,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('#div-port-member').show();
                            $('#select-port-member').attr('required', 'required');
                            $('#select-port-member').empty();
                            $('#select-port-member').append('<option value="">Select Port</option>');
                            $.each(data, function(key, value) {
                                $('#select-port-member').append('<option value="'+ value.id +'">'+ value.port +'</option>');
                            });
                        }
                    });
                }else{
                    $('#select-port-member').removeAttr('required');
                    $('#div-port-member').hide();
                }
        });

</script>

</body>
</html>
        
