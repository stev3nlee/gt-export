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
                                    <a href="{{ asset($product->thumbnail) }}" data-fancybox="fancy-product">
                                        <img src="{{ asset($product->thumbnail) }}" alt="" title=""/>
                                    </a>
                                </div>
                                @foreach($product->product_image as $image)
                                <div class="item">
                                    <a href="{{ asset($image->image) }}" data-fancybox="fancy-product">
                                        <img src="{{ asset($image->image) }}" alt="" title=""/>
                                    </a>
                                </div>
                                @endforeach
                            </div>
                            <div class="slider-thumb">
                                <div class="item">
                                    <img src="{{ asset($product->thumbnail) }}" alt="" title=""/>
                                </div>
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
                        <div class="merk">@if(isset($product->model[0])) {{ $product->model[0]->name }} @endif</div>
                        <div class="buy">Buy it at</div>
                        <div class="price">$ {{ number_format($product->price, 2, ',', '.') }}</div>
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
                        @if($product->description)
                        <div class="box-desc">
                            <div class="t-desc">What we love about this car</div>
                            <div class="desc">
                                {!! $product->description !!}
                            </div>
                        </div>
                        @endif
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
                    <div class="l-detail-t1">{{ number_format($product->engine_capacity, 2, ',', '.') }}cc</div>
                    <div class="l-detail-t2">Engine</div>
                </li>
                <li>
                    <div class="l-detail-t1">@if(isset($product->transmission[0])) {{ $product->transmission[0]->name }} @endif</div>
                    <div class="l-detail-t2">Transmission</div>
                </li>
                <li>
                    <div class="l-detail-t1">{{ $product->fuel }}</div>
                    <div class="l-detail-t2">Fuel</div>
                </li>
            </ul>
            <div class="text1">
                <div class="text1-row">
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Brand</div>
                                <div class="col-8 my-auto right">{{$product->brand[0]->name  ?? '-'}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Model</div>
                                <div class="col-8 my-auto right">{{$product->model[0]->name  ?? '-'}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Transmission</div>
                                <div class="col-8 my-auto right">{{$product->transmission[0]->name  ?? '-'}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Chassis No</div>
                                <div class="col-8 my-auto right">{{$product->chassis_no  ?? '-'}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Model Code</div>
                                <div class="col-8 my-auto right">{{$product->model_code  ?? '-'}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Product Type</div>
                                <div class="col-8 my-auto right">{{$product->product_type  ?? '-'}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Registeration Year/Month</div>
                                <div class="col-8 my-auto right">{{$product->registration_year  ?? '-'}}/{{$product->registration_month  ?? '-'}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Manufacture Year/Month</div>
                                <div class="col-8 my-auto right">{{$product->manufacture_year  ?? '-'}}/{{$product->manufacture_month  ?? '-'}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Engine No</div>
                                <div class="col-8 my-auto right">{{$product->engine_no  ?? '-'}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Steering</div>
                                <div class="col-8 my-auto right">{{$product->steering  ?? '-'}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Drive Type</div>
                                <div class="col-8 my-auto right">{{$product->drive_type  ?? '-'}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Color</div>
                                <div class="col-8 my-auto right">{{$product->color  ?? '-'}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Engine Code</div>
                                <div class="col-8 my-auto right">{{$product->engine_code  ?? '-'}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Number of Doors</div>
                                <div class="col-8 my-auto right">{{$product->number_of_doors  ?? '-'}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Seats</div>
                                <div class="col-8 my-auto right">{{$product->seats  ?? '-'}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Total Seats</div>
                                <div class="col-8 my-auto right">{{$product->total_seats  ?? '-'}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Weight(kg)</div>
                                <div class="col-8 my-auto right">{{$product->weight  ?? '-'}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="text1-col">
                        <div class="text1-bdr">
                            <div class="row">
                                <div class="col-4 my-auto left">Total weight(kg)</div>
                                <div class="col-8 my-auto right">{{$product->total_weight  ?? '-'}}</div>
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
        @if($product->reserve == 0)
        <div class="banner" style="background: url('{{ asset('images/banner-detail.jpg') }}') no-repeat center;">
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