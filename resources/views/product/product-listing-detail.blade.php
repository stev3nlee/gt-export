@extends('layout')

@section('content')
	
<div class="pad-content pb0">
    <div class="css-detail">
        <div class="container">
            <div class="mb70">
                <div class="row">
                    <div class="col-md-5 col-lg-6">
                        <div class="pr40">
                            <div class="pos-rel">
                                <div class="pagingInfo"></div>
                                <div class="slider-product">
                                    @foreach($product->product_image as $image)
                                    <div class="item">
                                        <a class="click-popup">
                                            <img src="{{ asset($image->image) }}" alt="" title=""/>
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @if($product->youtube)
                            <div class="video-product">
                                <iframe src="{{ $product->youtube }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                            @endif
                            <div>
                                <ul class="clearfix slider-thumb">
                                    <?php $i = 1; ?>
                                    @foreach($product->product_image as $image)
                                    <li class="item" data-slick="{{$i}}">
                                        <img src="{{ asset($image->image) }}" alt="" title=""/>
                                    </li>
                                    <?php $i++; ?>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="click-show"><div class="text-inside">Show thumbnails</div></div>
                            <div class="click-hide"><div class="text-inside">Hide thumbnails</div></div>
                            <div class="link-upload">
                                <div class="text-inside">
                                    <a href="{{ url('product-listing/download/'.$product->slug) }}"><i class="fas fa-download"></i> Download all images</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 col-lg-6">
                        <div class="detail-box">
                            <div class="buy">Buy it at</div>
                            @if($product->reserve == 0)
                                @if($product->discount_percent != 0)
                                    <div class="price">USD {{ number_format($product->price, 2, '.', ',') }}</div>
                                    <div class="buy-disc">Discount Price</div>
                                    <div class="price-disc">USD {{ number_format($product->discount_price, 2, '.', ',') }} <span class="save-price"> You save {{ $product->discount_percent }}% </span> </div>
                                @else
                                    <div class="price-wo-disc">USD {{ number_format($product->price, 2, '.', ',') }}</div>
                                    <!-- <div class="price-wo-disc">${{ number_format($product->price, 2, '.', ',') }}</div> -->
                                @endif
                            @endif
                            <div class="box-detail-inside">
                                <div class="merk mb15">{{ $product->registration_year }}<span class="merk">@if(isset($product->brand[0])) {{ $product->brand[0]->name }} @endif</span></div>
                                <div class="nm">{{ $product->model_code }}</div>
                                <div class="nm">@if(isset($product->model[0])) {{ $product->model[0]->name }} @endif</div>
                            </div>
                            @if($product->reserve == 0)
                            <div class="add">
                                <a>
                                    @if(session()->has('email'))
                                        <button type="button" class="hvr-button full100 click-submit-quote" data-product="{{ $product->slug }}">Ask for Quote</button>
                                    @else
                                        <button type="button" class="hvr-button full100 click-submit-quote-guest" data-product="{{ $product->slug }}">Ask for Quote</button>
                                    @endif
                                </a>
                            </div>
                        </div>
                        @endif
                        @if($product->description)
                        <div class="box-desc">
                            <div class="t-desc">What we love about this car</div>
                            <div class="desc">
                                {!! $product->description !!}
                            </div>
                        </div>
                        @endif
                        <div class="t1">Car Details</div>
                        <div class="t2">Economy & Performance</div>
                        <ul class="l-detail">
                            <li>
                                <div class="l-detail-t2">Mileage</div>
                                <div class="l-detail-t1">{{ number_format($product->mileage, 0, '.', ',') }} {{ $product->mileage_km }}</div>
                            </li>
                            <li>
                                <div class="l-detail-t2">Year</div>
                                <div class="l-detail-t1">{{ $product->registration_year }}</div>
                            </li>
                            <li>
                                <div class="l-detail-t2">Engine Capacity</div>
                                <div class="l-detail-t1">{{ number_format($product->engine_capacity, 0, '.', ',') }}cc</div>
                            </li>
                            <li>
                                <div class="l-detail-t2">Transmission</div>
                                <div class="l-detail-t1">@if(isset($product->transmission[0])) {{ $product->transmission[0]->name }} @endif</div> 
                            </li>
                            <li>
                                <div class="l-detail-t2">Fuel</div>
                                <div class="l-detail-t1">{{ $product->fuel }}</div>                   
                            </li>
                        </ul>
                        <div class="text1">
                            <div class="text1-row">
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Brand</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{$product->brand[0]->name  ?? '-'}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Mileage</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{ number_format($product->mileage, 0, '.', ',') }} {{ $product->mileage_km }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Chassis No</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{$product->chassis_no  ?? '-'}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Engine Code</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{$product->engine_code  ?? '-'}}</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Model Code</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{$product->model_code  ?? '-'}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Steering</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{$product->steering  ?? '-'}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Engine Size</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{ number_format($product->engine_capacity, 0, '.', ',') }}cc</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Ext. Color</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{$product->color  ?? '-'}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Location</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{$product->location  ?? '-'}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Fuel</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{$product->fuel  ?? '-'}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Version/Class</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{$product->product_type  ?? '-'}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Seats</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{$product->seats  ?? '-'}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Drive</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{$product->drive_type  ?? '-'}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Doors</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{$product->number_of_doors  ?? '-'}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Transmission</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{$product->transmission[0]->name  ?? '-'}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">M3</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{$product->dimension  ?? '-'}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Registration Year/Month</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{$product->registration_year  ?? '-'}}/{{$product->registration_month  ?? '-'}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Dimension</div>
                                            <div class="col-7 col-xl-8 my-auto right">@if($product->length && $product->width && $product->height) {{$product->length}} x {{$product->width}} x {{$product->height}} @else - @endif</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Manufacture Year/Month</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{$product->manufacture_year  ?? '-'}}/{{$product->manufacture_month  ?? '-'}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Weight(kg)</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{$product->weight  ?? '-'}}</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Max Cap</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{$product->total_seats  ?? '-'}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text1-col">
                                    <div class="text1-bdr">
                                        <div class="row">
                                            <div class="col-5 col-xl-4 my-auto left">Engine No</div>
                                            <div class="col-7 col-xl-8 my-auto right">{{$product->engine_no  ?? '-'}}</div>
                                        </div>
                                    </div>
                                </div>                  
                            </div>
                        </div>
                        <div class="bdr"></div>
                        <div class="t2">Exterior Features</div>
                        <div class="text2">
                            <div class="text2-row">
                                @foreach($accessories as $accs)
                                <div class="text2-col"><div class="text2-bdr @foreach($product->accessories as $acc) @if($acc->id == $accs->id) active @endif @endforeach">{{ $accs->name }}</div></div>
                                @endforeach
                            </div>
                        </div>
                        <div class="bdr"></div>
                        <div class="t2">Technical</div>
                        <div class="text3">{!! $product->remarks !!}</div>
                        <div class="bdr"></div>
                    </div>
                </div>
            </div>
            @if(count($related_products) > 0)
            <div class="bg-inventory">
                <div class="row">
                    <div class="col-6 my-auto">
                        <div class="t2">Similar and Related Products </div>
                    </div>
                </div>
            </div>
            <div class="css-product">
                <div class="row">
                    <div class="col-md-12 col-lg-12"  id="car-list">
                        <div class="row row-15">
                            <?php $count = 0; ?>
                            @foreach($related_products as $related)
                            <?php if($count == 12) break; ?>
                            <div class="col-6 col-md-4 col-lg-2 mb15">
                                <div class="item">
                                    <div class="pos-rel">                              
                                        <div class="img"> @if(isset($related->product_image[0]))<img src="{{ asset($related->product_image[0]->image) }}" alt="" title=""/>@endif</div>
                                        @if($related->reserve == 1)
                                            <div class="abs">Reserved</div>
                                        @elseif($related->reserve == 2)
                                            <div class="abs">Sold</div>
                                        @endif
                                        @if($related->new_arrival_expired_date != null)
                                            <div class="new">New Arrival</div>
                                        @endif
                                    </div>
                                    <a href="{{ URL::to('/product-listing-detail/'.$related->slug) }}">
                                        <div class="pad">
                                            <!-- <div class="year"></div> -->
                                            <div class="nm">{{ $product->registration_year }} @if(isset($product->brand[0])) {{ $product->brand[0]->name }} @endif</div>
                                            <!-- <div class="merk">@if(isset($product->model[0])) {{ $product->model[0]->name }} @endif</div> -->
                                            <div class="merk">@if(isset($product->model[0])) {{ $product->model_code }} @endif</div>
                                            <div class="merk">{{ $product->product_type }}</div>
                                            @if($product->price && $product->reserve == 0)
                                            @if($product->discount_percent != 0)
                                            <div class="price"><span class="price-strike">${{ number_format($product->price, 0, '.', ',') }}</span><span class="price-disc">$ {{ number_format($product->discount_price, 0, '.', ',') }}</span></div>
                                            <div class="save-disc">You save {{ $product->discount_percent }}%</div>
                                            @else
                                            <div class="price-wo-disc">${{ number_format($product->price, 0, '.', ',') }}</div>
                                            @endif
                                            @endif
                                            <!--<div class="stock">Stock # {{ $product->stock }}</div>-->
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <?php $count++; ?>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @if($product->reserve == 0)
        <div class="banner" style="margin-top: 40px; background: url('{{ asset('images/banner-detail.jpg') }}') no-repeat center;">
            <div class="container">
                <div class="t-banner">Interested?</div>
                <div class="bdy-banner">
                    <p>Get in touch with our sales partner for more information.</p>
                </div>

                <div class="link">
                    @if(session()->has('email'))
                        <button type="button" class="hvr-button click-submit-quote" data-product="{{ $product->slug }}">Get Quote</button>
                    @else
                        <button type="button" class="hvr-button click-submit-quote-guest" data-product="{{ $product->slug }}">Get Quote</button>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="popup-product">
    <div class="popup-close"><i class="fas fa-times"></i></div>
    <div class="pagingInfo"></div>
    <div class="abs-popup">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <div class="slider-popup-product">
                    @foreach($product->product_image as $image)
                    <div class="item">
                        <a>
                            <img src="{{ asset($image->image) }}" alt="" title=""/>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/jquery.zoom.min.js') }}"></script>
<!-- <script type="text/javascript" src="{{ asset('js/fancybox/jquery.fancybox.min.js') }}"></script> -->

<script type="text/javascript">
	$(document).ready(function() {
        var $status = $('.pagingInfo');

        $('.slider-product').on('init reInit afterChange', function(event, slick, currentSlide, nextSlide) {
            var i = (currentSlide ? currentSlide : 0) + 1;
            $status.text(i + '/' + slick.slideCount);
        });

        $('.slider-product').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            fade: false,
            asNavFor: '.slider-thumb,.slider-popup-product',
            infinite: false
        });

        $('.slider-thumb').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            asNavFor: '.slider-product,.slider-popup-product',
            dots: false,
            arrows: false,
            centerMode: false,
            focusOnSelect: true,
            infinite: false,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 4,
                    }
                }
            ]
        });

        $('.slider-popup-product').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            dots: false,
            swipe: false,
            fade: false,
            asNavFor: '.slider-product,.slider-thumb',
            infinite: false
        });

        $('.click-popup').click(function(event) {
            $('.popup-product').show();
            $('body').addClass('no-scroll-popup');
            $('.slider-popup-product').slick('setPosition');
        });

        $('.slider-popup-product .item').zoom({ on:'grab' });

        $('.popup-close').click(function(event) {
            $('.popup-product').hide();
            $('body').removeClass('no-scroll-popup');
        });

        $('.click-show').click(function() {
            $('.slider-thumb').slick('unslick');
            $(this).hide();
            $('.click-hide').show();

            $('.slider-thumb .item').click(function() {
                var getSlick = $(this).attr('data-slick');
                $('.slider-product').slick('slickGoTo', getSlick-1);
            });
        });

        $('.popup-close').click(function(event) {
            $('.popup-product').hide();
            $('body').removeClass('no-scroll-popup');
        });

        $('.click-hide').click(function() {
            $('.slider-thumb').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                asNavFor: '.slider-product',
                dots: false,
                arrows: false,
                centerMode: false,
                focusOnSelect: true,
                infinite: false,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 4,
                        }
                    }
                ]
            });
            $(this).hide();
            $('.click-show').show();
        });

        $('.nav-product').addClass('active');

        // $("[data-fancybox]").fancybox({
        //     infobar : false,
        //     buttons : [
        //         'close',
        //     ],
        //     loop: false,
        //     idleTime: false,
        // });

        @if(Session::has('product_login'))
        jQuery(function(){
           jQuery('.click-submit-quote').click();
        });
        @endif
    });
</script>
@endsection