@extends('layout')

@section('content')
    <div class="pad-content">
        <div class="css-procurement">
            <div class="container">
                <div class="title">Procurement Flow</div>
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8">
                        <div class="t1">How we do it</div>
                        <div class="bdy">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. At varius vel pharetra vel turpis nunc. Enim ut tellus elementum sagittis vitae et. Laoreet sit amet cursus sit amet dictum sit. </p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-9">
                        <div class="pos-rel">
                            <div class="bdr-tab"></div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="step1-tab" data-toggle="tab" href="#step1" role="tab" aria-controls="step1" aria-selected="true">
                                        <div class="bdr"></div>
                                        <div class="num">01</div>
                                        <div class="img">
                                            <img src="{{ asset('images/step01.png') }}" alt="" title="" class="img-noactive"/>
                                            <img src="{{ asset('images/step01-active.png') }}" alt="" title="" class="img-active"/>
                                        </div>
                                        <div class="nm">Selection of Vehicle</div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="step2-tab" data-toggle="tab" href="#step2" role="tab" aria-controls="step2" aria-selected="false">
                                        <div class="bdr"></div>
                                        <div class="num">02</div>
                                        <div class="img">
                                            <img src="{{ asset('images/step02.png') }}" alt="" title="" class="img-noactive"/>
                                            <img src="{{ asset('images/step02-active.png') }}" alt="" title="" class="img-active"/>
                                        </div>
                                        <div class="nm">Payment</div>
                                    </a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="step3-tab" data-toggle="tab" href="#step3" role="tab" aria-controls="step3" aria-selected="false">
                                        <div class="bdr"></div>
                                        <div class="num">03</div>
                                        <div class="img">
                                            <img src="{{ asset('images/step03.png') }}" alt="" title="" class="img-noactive"/>
                                            <img src="{{ asset('images/step03-active.png') }}" alt="" title="" class="img-active"/>
                                        </div>
                                        <div class="nm">Delivery</div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content div-step">
                            <div class="tab-pane fade show active" id="step1" role="tabpanel" aria-labelledby="step1-tab">
                                <div class="t">Step 1</div>
                                <div class="t2">Selection of Vehicle</div>
                                <div class="desc">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. At varius vel pharetra vel turpis nunc. Enim ut tellus elementum sagittis vitae et. Laoreet sit amet cursus sit amet dictum sit.</p>
                                    <p>Egestas sed sed risus pretium. Ullamcorper velit sed ullamcorper morbi. Dictumst quisque sagittis purus sit amet volutpat. Id neque aliquam vestibulum morbi blandit cursus. Id nibh tortor id aliquet lectus proin nibh nisl. Faucibus scelerisque eleifend donec pretium vulputate. Potenti nullam ac tortor vitae. Dolor morbi non arcu risus quis varius quam quisque id. Accumsan in nisl nisi scelerisque eu ultrices.</p>
                                    <p>Et pharetra pharetra massa massa ultricies. Vitae purus faucibus ornare suspendisse sed nisi. Tortor posuere ac ut consequat semper viverra nam libero justo.</p>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-right">
                                        <div class="link-step">
                                            <a class="click-payment">
                                                <div class="text1">Next <i class="fas fa-chevron-right"></i></div>
                                                <div class="text2">Payment</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="step2" role="tabpanel" aria-labelledby="step2-tab">
                                <div class="t">Step 2</div>
                                <div class="t2">Payment</div>
                                <div class="desc">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. At varius vel pharetra vel turpis nunc. Enim ut tellus elementum sagittis vitae et. Laoreet sit amet cursus sit amet dictum sit.</p>
                                    <p>Egestas sed sed risus pretium. Ullamcorper velit sed ullamcorper morbi. Dictumst quisque sagittis purus sit amet volutpat. Id neque aliquam vestibulum morbi blandit cursus. Id nibh tortor id aliquet lectus proin nibh nisl. Faucibus scelerisque eleifend donec pretium vulputate. Potenti nullam ac tortor vitae. Dolor morbi non arcu risus quis varius quam quisque id. Accumsan in nisl nisi scelerisque eu ultrices.</p>
                                    <p>Et pharetra pharetra massa massa ultricies. Vitae purus faucibus ornare suspendisse sed nisi. Tortor posuere ac ut consequat semper viverra nam libero justo.</p>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="link-step left">
                                            <a class="click-vehicle">
                                                <div class="text1">Previous <i class="fas fa-chevron-left"></i></div>
                                                <div class="text2">Selection of Vehicle</div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-6 text-right">
                                        <div class="link-step">
                                            <a class="click-delivery">
                                                <div class="text1">Next <i class="fas fa-chevron-right"></i></div>
                                                <div class="text2">Delivery</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="step3" role="tabpanel" aria-labelledby="step3-tab">
                                <div class="t">Step 3</div>
                                <div class="t2">Delivery</div>
                                <div class="desc">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. At varius vel pharetra vel turpis nunc. Enim ut tellus elementum sagittis vitae et. Laoreet sit amet cursus sit amet dictum sit.</p>
                                    <p>Egestas sed sed risus pretium. Ullamcorper velit sed ullamcorper morbi. Dictumst quisque sagittis purus sit amet volutpat. Id neque aliquam vestibulum morbi blandit cursus. Id nibh tortor id aliquet lectus proin nibh nisl. Faucibus scelerisque eleifend donec pretium vulputate. Potenti nullam ac tortor vitae. Dolor morbi non arcu risus quis varius quam quisque id. Accumsan in nisl nisi scelerisque eu ultrices.</p>
                                    <p>Et pharetra pharetra massa massa ultricies. Vitae purus faucibus ornare suspendisse sed nisi. Tortor posuere ac ut consequat semper viverra nam libero justo.</p>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="link-step left">
                                            <a class="click-payment">
                                                <div class="text1">Previous <i class="fas fa-chevron-left"></i></div>
                                                <div class="text2">Payment</div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        $('.nav-procurement').addClass('active');

        $('.click-vehicle').on('click', function (event) {
            event.preventDefault();
            $('#step1').tab('show');
            $('#step2,#step3').removeClass('show');
            $('#step2,#step3').removeClass('active');
            $('.nav-link').removeClass('active');
            $('#step1-tab').addClass('active');
            $("body, html").animate({
                scrollTop: $(".div-step").position().top
            });
        });
        $('.click-payment').on('click', function (event) {
            event.preventDefault();
            $('#step2').tab('show');
            $('#step1,#step3').removeClass('show');
            $('#step1,#step3').removeClass('active');
            $('.nav-link').removeClass('active');
            $('#step2-tab').addClass('active');
            $("body, html").animate({
                scrollTop: $(".div-step").position().top
            });
        });
        $('.click-delivery').on('click', function (event) {
            event.preventDefault();
            $('#step3').tab('show');
            $('#step1,#step2').removeClass('show');
            $('#step1,#step2').removeClass('active');
            $('.nav-link').removeClass('active');
            $('#step3-tab').addClass('active');
            $("body, html").animate({
                scrollTop: $(".div-step").position().top
            });
        });
	});
</script>
@endsection