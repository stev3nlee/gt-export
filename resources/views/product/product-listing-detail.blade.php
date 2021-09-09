@extends('layout')

@section('content')
	
<div class="pad-content pb0">
    <div class="css-detail">
        <div class="container">
            <div class="mb70">
                <div class="row">
                    <div class="col-md-7 col-lg-8">
                        <div class="pr40">
                            <div class="slider-product">
                                <div class="item">
                                    <a href="{{ asset('images/detail1.jpg') }}" data-fancybox="fancy-product">
                                        <img src="{{ asset('images/detail1.jpg') }}" alt="" title=""/>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="{{ asset('images/detail2.jpg') }}" data-fancybox="fancy-product">
                                        <img src="{{ asset('images/detail2.jpg') }}" alt="" title=""/>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="{{ asset('images/detail3.jpg') }}" data-fancybox="fancy-product">
                                        <img src="{{ asset('images/detail3.jpg') }}" alt="" title=""/>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="{{ asset('images/detail4.jpg') }}" data-fancybox="fancy-product">
                                        <img src="{{ asset('images/detail4.jpg') }}" alt="" title=""/>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="{{ asset('images/detail5.jpg') }}" data-fancybox="fancy-product">
                                        <img src="{{ asset('images/detail5.jpg') }}" alt="" title=""/>
                                    </a>
                                </div>
                                <div class="item">
                                    <a href="{{ asset('images/detail1.jpg') }}" data-fancybox="fancy-product">
                                        <img src="{{ asset('images/detail1.jpg') }}" alt="" title=""/>
                                    </a>
                                </div>
                            </div>
                            <div class="slider-thumb">
                                <div class="item">
                                    <img src="{{ asset('images/thumb1.jpg') }}" alt="" title=""/>
                                </div>
                                <div class="item">
                                    <img src="{{ asset('images/thumb2.jpg') }}" alt="" title=""/>
                                </div>
                                <div class="item">
                                    <img src="{{ asset('images/thumb3.jpg') }}" alt="" title=""/>
                                </div>
                                <div class="item">
                                    <img src="{{ asset('images/thumb4.jpg') }}" alt="" title=""/>
                                </div>
                                <div class="item">
                                    <img src="{{ asset('images/thumb5.jpg') }}" alt="" title=""/>
                                </div>
                                <div class="item">
                                    <img src="{{ asset('images/thumb1.jpg') }}" alt="" title=""/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-4">
                        <div class="merk">Porsche</div>
                        <div class="nm">Macan GTS</div>
                        <div class="buy">Buy it at</div>
                        <div class="price">$ 500,000</div>
                        <div class="add">
                            <a href="{{ URL::to('/contact-us') }}">
                                <button type="button" class="hvr-button full100">Ask for Quote</button>
                            </a>
                        </div>
                        <div class="box-desc">
                            <div class="t-desc">What we love about this car</div>
                            <div class="desc">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. A gravida tempor tristique dignissim velit. Ut ante ultrices lectus arcu id leo.</p>
                                <p>Eget vulputate enim tellus non facilisis congue amet nisl. Aliquam sed enim mattis interdum sollicitudin sit pulvinar urna.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="t1">Car Details</div>
            <div class="t2">Economy & Performance</div>
            <ul class="l-detail">
                <li>
                    <div class="l-detail-t1">100,000 km</div>
                    <div class="l-detail-t2">Mileage</div>
                </li>
                <li>
                    <div class="l-detail-t1">2014</div>
                    <div class="l-detail-t2">Year</div>
                </li>
                <li>
                    <div class="l-detail-t1">2,000cc</div>
                    <div class="l-detail-t2">Engine</div>
                </li>
                <li>
                    <div class="l-detail-t1">Automatic</div>
                    <div class="l-detail-t2">Transmission</div>
                </li>
                <li>
                    <div class="l-detail-t1">Petrol</div>
                    <div class="l-detail-t2">Fue</div>
                </li>
            </ul>
            <div class="text1">
                <div class="text1-row">
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Category1</div>
                                <div class="col-8 my-auto right">Category1</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Category1</div>
                                <div class="col-8 my-auto right">Category1</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Category1</div>
                                <div class="col-8 my-auto right">Category1</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Category1</div>
                                <div class="col-8 my-auto right">Category1</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Category1</div>
                                <div class="col-8 my-auto right">Category1</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Category1</div>
                                <div class="col-8 my-auto right">Category1</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Category1</div>
                                <div class="col-8 my-auto right">Category1</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Category1</div>
                                <div class="col-8 my-auto right">Category1</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Category1</div>
                                <div class="col-8 my-auto right">Category1</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Category1</div>
                                <div class="col-8 my-auto right">Category1</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Category1</div>
                                <div class="col-8 my-auto right">Category1</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Category1</div>
                                <div class="col-8 my-auto right">Category1</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Category1</div>
                                <div class="col-8 my-auto right">Category1</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Category1</div>
                                <div class="col-8 my-auto right">Category1</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Category1</div>
                                <div class="col-8 my-auto right">Category1</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Category1</div>
                                <div class="col-8 my-auto right">Category1</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Category1</div>
                                <div class="col-8 my-auto right">Category1</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Category1</div>
                                <div class="col-8 my-auto right">Category1</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Category1</div>
                                <div class="col-8 my-auto right">Category1</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Category1</div>
                                <div class="col-8 my-auto right">Category1</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bdr"></div>
            <div class="t2">Exterior Features</div>
            <div class="text2">
                <div class="text2-row">
                    <div class="text2-col"><div class="text2-bdr active">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr active">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr active">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr active">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                    <div class="text2-col"><div class="text2-bdr">360 Degree Camera</div></div>
                </div>
            </div>
            <div class="bdr"></div>
            <div class="t2">Technical</div>
            <div class="text3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. A gravida tempor tristique dignissim velit. Ut ante ultrices lectus arcu id leo.</div>
            <div class="bdr"></div>
        </div>
        <div class="banner" style="background: url('images/banner-detail.jpg') no-repeat center;">
            <div class="container">
                <div class="t-banner">Interested?</div>
                <div class="bdy-banner">
                    <p>Get in touch with our sales partner for more information.</p>
                </div>
                <div class="link">
                    <a href="{{ URL::to('/contact-us') }}">
                        <button type="button" class="hvr-button">Get Quote</button>
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
		 $('.slider-product').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: false,
            asNavFor: '.slider-thumb'
        });

        $('.slider-thumb').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            asNavFor: '.slider-product',
            dots: false,
            arrows: false,
            centerMode: false,
            focusOnSelect: true
        });

        $('.nav-product').addClass('active');

        $('.fancybox').fancybox();
	});
</script>
@endsection