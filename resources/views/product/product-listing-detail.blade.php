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
                                @foreach($product->product_image as $image)
                                <div class="item">
                                    <a href="{{ asset($image->image) }}" data-fancybox="fancy-product">
                                        <img src="{{ asset($image->image) }}" alt="" title=""/>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            <div class="slider-thumb">
                                @foreach($product->product_image as $image)
                                <div class="item">
                                    <img src="{{ asset($image->image) }}" alt="" title=""/>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-lg-4">
                        <div class="merk">{{ $product->registration_year }}</div>
                        <div class="nm">@if(isset($product->brand[0])) {{ $product->brand[0]->name }} @endif</div>
                        <div class="buy">Buy it at</div>
                        <div class="price">$ {{ number_format($product->price, 2, '.', ',') }}</div>
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
                        @endif
                        <div class="box-desc">
                            <div class="t-desc">What we love about this car</div>
                            <div class="desc">
                                {!! $product->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="t1">Car Details</div>
            <div class="t2">Economy & Performance</div>
            <ul class="l-detail">
                <li>
                    <div class="l-detail-t1">{{ number_format($product->mileage, 0, '.', ',') }} {{ $product->mileage_km }}</div>
                    <div class="l-detail-t2">Mileage</div>
                </li>
                <li>
                    <div class="l-detail-t1">{{ $product->registration_year }}</div>
                    <div class="l-detail-t2">Year</div>
                </li>
                <li>
                    <div class="l-detail-t1">{{ number_format($product->engine_capacity, 0, '.', ',') }}cc</div>
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
                    @foreach($product->accessories as $acc)
                    {{ $acc->name }}
                    @endforeach
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
            <div class="text3">{!! $product->remarks !!}</div>
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