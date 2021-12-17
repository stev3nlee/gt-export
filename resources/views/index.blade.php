@extends('layout')

@section('content')

    <div class="css-home">
        @if($banners)
        <div class="banner-home" style="background: url('upload/banner/{{ $banners->image }}') no-repeat center;">
            <div class="container pos-rel">
                <div class="abs-banner">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-xl-6">
                            <div class="t-banner">{!! $banners->name !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="container">
            <div class="bg-find">
                @if(!$banners)
                <div class="abs-banner">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-xl-6">
                            <div class="t-banner">{!! $banner_title->name !!}</div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="t-find">Find Your Vehicle</div>
                <div class="search">
                    <form action="{{ URL::to('/product-listing') }}">
                        <input class="form-control" type="text" name="search" placeholder="Search for Used Car" />
                        <button type="submit"><img src="{{ asset('images/search2.png') }}" alt="" title=""/></button>
                    </form>
                </div>
                <form action="{{ url('product-listing') }}">
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <div class="form-group">
                                <label for="brand">Product Category Type:</label>
                                <div class="css-select">
                                    <select name="category_type" class="form-control" id="category_type" required="">
                                        <option selected="" disabled="">All Types</option>
                                        <option value="all">All Cars</option>
                                        <option value="newly">Newly Added</option>
                                        <option value="clearance">Clearance Section</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="form-group">
                                <label for="brand">Select Brand:</label>
                                <div class="css-select">
                                    <select name="brand" class="form-control" id="select-brand" required="">
                                        <option selected="" disabled="">All Brands</option>
                                        @foreach($brands as $brand)
                                        <option value="{{ $brand->slug }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="form-group">
                                <label for="model">Select Model:</label>
                                <div class="css-select">
                                    <select name="model" class="form-control" id="model" required="">
                                        <option selected="" disabled="">All Models</option>
                                        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="form-group">
                                <label for="brand">Select Transmission Type:</label>
                                <div class="css-select">
                                    <select name="transmission" class="form-control" id="brand" required="">
                                        <option selected="" disabled="">All Types</option>
                                        @foreach($transmissions as $transmission)
                                        <option value="{{ $transmission->slug }}">{{ $transmission->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="form-group">
                                <label for="brand">Select Car Type:</label>
                                <div class="css-select">
                                    <?php $types = array('Bus','Bus 20 Seats','Convertible','Coupe','Hatchback','Mini Bus','Mini Van','Mini Vehicle','Pick Up','Sedan','SUV','Truck','Van','Wagon','Forklift','Machinery','Tractor') ?>
                                    <select name="car_type" class="form-control" id="car_type" required="">
                                        <option selected="" disabled="">All Car Type</option>
                                        @foreach($types as $type)
                                        <option value="{{ $type }}">{{ $type }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="range_min" id="range-min">
                        <input type="hidden" name="range_max" id="range-max">
                    </div>
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <div class="form-group">
                                <label>&nbsp;</label>
                                <button type="submit" class="hvr-button full100">Search Inventory</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-5">
                        <div class="t-price">Price Range</div>
                        <div class="row">
                            <div class="col-6 my-auto">
                                <input class="bdr-range" type="text" id="amount-1" readonly name="">
                            </div>
                            <div class="col-6 my-auto text-right">
                                <input class="bdr-range" type="text" id="amount-2" readonly name="">
                            </div>
                        </div>
                        <div class="pad-range">
                            <div id="slider-range"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-inventory">
            <div class="container">
                <div class="row">
                    <div class="col-6 my-auto">
                        <div class="t">Recently viewed </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="css-product">
                <div class="row">
                    <div class="col-md-12 col-lg-12"  id="car-list">
                        <div class="row row-15">
                            @foreach($recently_views as $product)
                            <div class="col-6 col-md-4 col-lg-2">
                                <div class="item">
                                    <div class="pos-rel">                                        
                                        <div class="img"> @if(isset($product->product_image[0]))<img src="{{ asset($product->product_image[0]->image) }}" alt="" title=""/>@endif</div>
                                        @if($product->reserve == 1)
                                            <div class="abs">Reserved</div>
                                        @elseif($product->reserve == 2)
                                            <div class="abs">Sold</div>
                                        @endif
                                        @if($product->new_arrival_expired_date != null)
                                            <div class="new">New Arrival</div>
                                        @endif
                                        @if($product->reserve == 0)
                                        <div class="abs-get">
                                        @if(session()->has('email'))
                                            <a style="cursor: pointer;" class="click-submit-quote" data-product="{{ $product->slug }}">Get Quote</a>
                                        @else
                                            <a style="cursor: pointer;" class="click-submit-quote-guest" data-product="{{ $product->slug }}">Get Quote</a>
                                        @endif
                                        </div>
                                        @endif
                                    </div>
                                    <a href="{{ URL::to('/product-listing-detail/'.$product->slug) }}">
                                        <div class="pad">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="year">{{ $product->registration_year }}</div>
                                                    <div class="nm">@if(isset($product->brand[0])) {{ $product->brand[0]->name }} @endif</div>
                                                    <div class="merk">{{ $product->model_code }}</div>
                                                    <div class="merk">{{ $product->product_type }}</div>
                                                </div>
                                                <div class="col-6 text-right">
                                                    @if($product->price && $product->reserve == 0)
                                                    @if($product->discount_price != 0)
                                                    <div class="price">${{ number_format($product->price, 0, '.', ',') }}</div>
                                                    <div class="price-disc">$ {{ number_format($product->discount_price, 0, '.', ',') }}</div>
                                                    <div class="save-disc">You save {{ $product->discount_percent }}%</div>
                                                    @else
                                                    <div class="price-wo-disc">${{ number_format($product->price, 0, '.', ',') }}</div>
                                                    @endif
                                                    @endif
                                                    <!--<div class="stock">Stock # {{ $product->stock }}</div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-inventory">
            <div class="container">
                <div class="row">
                    <div class="col-6 my-auto">
                        <div class="t">Newly Added</div>
                    </div>
                    <div class="col-6 my-auto text-right">
                        <div class="view">
                            <a href="{{ URL::to('/product-listing?category_type=newly') }}">
                                <button type="button" class="hvr-button">View All</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="css-product">
                <div class="row">
                    <div class="col-md-12 col-lg-12"  id="car-list">
                        <div class="row row-15">
                            @foreach($new_arrivals as $product)
                            <div class="col-6 col-md-4 col-lg-2">
                                <div class="item">
                                    <div class="pos-rel">                                        
                                        <div class="img"> @if(isset($product->product_image[0]))<img src="{{ asset($product->product_image[0]->image) }}" alt="" title=""/>@endif</div>
                                        @if($product->reserve == 1)
                                            <div class="abs">Reserved</div>
                                        @elseif($product->reserve == 2)
                                            <div class="abs">Sold</div>
                                        @endif
                                        @if($product->new_arrival_expired_date != null)
                                            <div class="new">New Arrival</div>
                                        @endif
                                        @if($product->reserve == 0)
                                        <div class="abs-get">
                                        @if(session()->has('email'))
                                            <a style="cursor: pointer;" class="click-submit-quote" data-product="{{ $product->slug }}">Get Quote</a>
                                        @else
                                            <a style="cursor: pointer;" class="click-submit-quote-guest" data-product="{{ $product->slug }}">Get Quote</a>
                                        @endif
                                        </div>
                                        @endif
                                    </div>
                                    <a href="{{ URL::to('/product-listing-detail/'.$product->slug) }}">
                                        <div class="pad">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="year">{{ $product->registration_year }}</div>
                                                    <div class="nm">@if(isset($product->brand[0])) {{ $product->brand[0]->name }} @endif</div>
                                                    <div class="merk">{{ $product->model_code }}</div>
                                                    <div class="merk">{{ $product->product_type }}</div>
                                                </div>
                                                <div class="col-6 text-right">
                                                    @if($product->price && $product->reserve == 0)
                                                    @if($product->discount_price != 0)
                                                    <div class="price">${{ number_format($product->price, 0, '.', ',') }}</div>
                                                    <div class="price-disc">$ {{ number_format($product->discount_price, 0, '.', ',') }}</div>
                                                    <div class="save-disc">You save {{ $product->discount_percent }}%</div>
                                                    @else
                                                    <div class="price-wo-disc">${{ number_format($product->price, 0, '.', ',') }}</div>
                                                    @endif
                                                    @endif
                                                    <!--<div class="stock">Stock # {{ $product->stock }}</div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-inventory">
            <div class="container">
                <div class="row">
                    <div class="col-6 my-auto">
                        <div class="t">Clearance Selection</div>
                    </div>
                    <div class="col-6 my-auto text-right">
                        <div class="view">
                            <a href="{{ URL::to('/product-listing?category_type=clearance') }}">
                                <button type="button" class="hvr-button">View All</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="css-product">
                <div class="row">
                    <div class="col-md-12 col-lg-12"  id="car-list">
                        <div class="row row-15">
                            @foreach($discounts as $product)
                            <div class="col-6 col-md-4 col-lg-2">
                                <div class="item">
                                    <div class="pos-rel">                                        
                                        <div class="img"> @if(isset($product->product_image[0]))<img src="{{ asset($product->product_image[0]->image) }}" alt="" title=""/>@endif</div>
                                        @if($product->reserve == 1)
                                            <div class="abs">Reserved</div>
                                        @elseif($product->reserve == 2)
                                            <div class="abs">Sold</div>
                                        @endif
                                        @if($product->new_arrival_expired_date != null)
                                            <div class="new">New Arrival</div>
                                        @endif
                                        @if($product->reserve == 0)
                                        <div class="abs-get">
                                        @if(session()->has('email'))
                                            <a style="cursor: pointer;" class="click-submit-quote" data-product="{{ $product->slug }}">Get Quote</a>
                                        @else
                                            <a style="cursor: pointer;" class="click-submit-quote-guest" data-product="{{ $product->slug }}">Get Quote</a>
                                        @endif
                                        </div>
                                        @endif
                                    </div>
                                    <a href="{{ URL::to('/product-listing-detail/'.$product->slug) }}">
                                        <div class="pad">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="year">{{ $product->registration_year }}</div>
                                                    <div class="nm">@if(isset($product->brand[0])) {{ $product->brand[0]->name }} @endif</div>
                                                    <div class="merk">{{ $product->model_code }}</div>
                                                    <div class="merk">{{ $product->product_type }}</div>
                                                </div>
                                                <div class="col-6 text-right">
                                                    @if($product->price && $product->reserve == 0)
                                                    @if($product->discount_price != 0)
                                                    <div class="price">${{ number_format($product->price, 0, '.', ',') }}</div>
                                                    <div class="price-disc">$ {{ number_format($product->discount_price, 0, '.', ',') }}</div>
                                                    <div class="save-disc">You save {{ $product->discount_percent }}%</div>
                                                    @else
                                                    <div class="price-wo-disc">${{ number_format($product->price, 0, '.', ',') }}</div>
                                                    @endif
                                                    @endif
                                                    <!--<div class="stock">Stock # {{ $product->stock }}</div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-inventory">
            <div class="container">
                <div class="row">
                    <div class="col-6 my-auto">
                        <div class="t">Our Inventory</div>
                    </div>
                    <div class="col-6 my-auto text-right">
                        <div class="view">
                            <a href="{{ URL::to('/product-listing') }}">
                                <button type="button" class="hvr-button">View All</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="css-product">
                <div class="row">
                    <div class="col-md-3 xs20">
                        <div class="t-brand">Our Brands</div>
                        <div class="clearfix">
                            <ul class="l-brand">
                                <?php $i=1 ?>
                                @foreach($brands as $brand)
                                <li>
                                    <a href="{{ url('/?brand='.$brand->slug) }}" @if($brand_id == $brand->id) class="active" @endif>
                                        <div>{{ $brand->name }}</div>
                                        <div class="img"><img src="{{ asset('images/arrow-brand.png') }}" alt="" title=""/></div>
                                    </a>
                                </li>
                                <?php $i++; ?>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9" id="car-list">
                        <div class="row row-15">
                            @foreach($products as $product)
                            <div class="col-6 col-md-4 col-xl-3">
                                <div class="item">
                                    <div class="pos-rel">                 
                                        <div class="img"> @if(isset($product->product_image[0]))<img src="{{ asset($product->product_image[0]->image) }}" alt="" title=""/>@endif</div>
                                        @if($product->reserve == 1)
                                            <div class="abs">Reserved</div>
                                        @elseif($product->reserve == 2)
                                            <div class="abs">Sold</div>
                                        @endif
                                        @if($product->new_arrival_expired_date != null)
                                            <div class="new">New Arrival</div>
                                        @endif
                                        @if($product->reserve == 0)
                                        <div class="abs-get">
                                        @if(session()->has('email'))
                                            <a style="cursor: pointer;" class="click-submit-quote" data-product="{{ $product->slug }}">Get Quote</a>
                                        @else
                                            <a style="cursor: pointer;" class="click-submit-quote-guest" data-product="{{ $product->slug }}">Get Quote</a>
                                        @endif
                                        </div>
                                        @endif
                                    </div>
                                    <a href="{{ URL::to('/product-listing-detail/'.$product->slug) }}">
                                        <div class="pad">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="year">{{ $product->registration_year }}</div>
                                                    <div class="nm">@if(isset($product->brand[0])) {{ $product->brand[0]->name }} @endif</div>
                                                    <div class="merk">{{ $product->model_code }}</div>
                                                    <div class="merk">{{ $product->product_type }}</div>
                                                </div>
                                                <div class="col-md-6 text-right">
                                                    @if($product->price && $product->reserve == 0)
                                                    @if($product->discount_price != 0)
                                                    <div class="price">${{ number_format($product->price, 0, '.', ',') }}</div>
                                                    <div class="price-disc">$ {{ number_format($product->discount_price, 0, '.', ',') }}</div>
                                                    <div class="save-disc">You save {{ $product->discount_percent }}%</div>
                                                    @else
                                                    <div class="price-wo-disc">${{ number_format($product->price, 0, '.', ',') }}</div>
                                                    @endif
                                                    @endif
                                                    <!--<div class="stock">Stock # {{ $product->stock }}</div>-->
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-about">
            <div class="row">
                <div class="col-md-6 blue order-2 order-md-1">
                    <div class="abs">
                        <div class="clearfix">
                            <div class="t">You deserve quality and reliability.</div>
                        </div>
                        <div class="link">
                            <a href="{{ url('register') }}">
                                <button type="button" class="hvr-button full100">Sign up and start dealing now.</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 order-1 order-md-2">
                    <div class="img"><img src="{{ asset('images/home1.jpg') }}" alt="" title=""/></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="img"><img src="{{ asset('images/home2.jpg') }}" alt="" title=""/></div>
                </div>
                <div class="col-md-6 grey">
                    <div class="abs2">
                        <div class="t2">About Us</div>
                        <div class="desc">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Iaculis gravida adipiscing faucibus aliquet donec a tincidunt interdum euismod. In leo, suspendisse fringilla dictum risus dignissim volutpat nibh. Ipsum nibh id enim nunc, dui, risus, bibendum venenatis, suscipit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Iaculis gravida adipiscing faucibus aliquet donec a tincidunt interdum euismod. In leo, suspendisse fringilla dictum risus dignissim volutpat nibh. Ipsum nibh id enim nunc, dui, risus, bibendum venenatis, suscipit.</p>
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
		$('header').addClass('abs');

        $( "#slider-range" ).slider({
            range: true,
            min: 0,
            max: {{ $highest_price }},
            step: 1,
            values: [ 0, {{ $highest_price }} ],
            slide: function( event, ui ) {
                $( "#amount-1" ).val( "$ " + numberThousand(ui.values[ 0 ]));
                $( "#amount-2" ).val( "$ " + numberThousand(ui.values[ 1 ]));
                $( "#range-min" ).val( ui.values[ 0 ]);
                $( "#range-max" ).val( ui.values[ 1 ]);
            }
        });

        function numberThousand(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        $( "#amount-1" ).val( "$ " + numberThousand($( "#slider-range" ).slider( "values", 0 )));
        $( "#amount-2" ).val( "$ " + numberThousand($( "#slider-range" ).slider( "values", 1 )));
        $( "#range-min" ).val( $( "#slider-range" ).slider( "values", 0 ));
        $( "#range-max" ).val( $( "#slider-range" ).slider( "values", 1 ));

        var field = 'brand';
        var url = window.location.href;
        if(url.indexOf('?' + field + '=') != -1)
            $('html,body').animate({
                scrollTop: $('#car-list').offset().top -30
            });
        else if(url.indexOf('&' + field + '=') != -1)
            $('html,body').animate({
                scrollTop: $('#car-list').offset().top -30
            });

         $('#select-brand').on('change', function() {
                var brandID = $(this).val();
                if(brandID) {
                    $.ajax({
                        url: '{{ url("brand/getModelSlug") }}/'+brandID,
                        type: "GET",
                        dataType: "json",
                        success:function(data) {
                            $('#model').empty();
                            $('#model').append('<option value="">All Models</option>');
                            $.each(data, function(key, value) {
                                $('#model').append('<option value="'+ value.slug +'">'+ value.name +'</option>');
                            });
                        }
                    });
                }else{
                    $('#model').empty();
                }
        });
	});
</script>
@endsection