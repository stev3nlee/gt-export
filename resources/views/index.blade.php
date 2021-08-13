@extends('layout')

@section('content')

    <div class="css-home">
        <div class="banner-home" style="background: url('images/banner-home.jpg') no-repeat center;">
            <div class="container pos-rel">
                <div class="abs-banner">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-xl-6">
                            <div class="t-banner">Lorem ipsum dolor sit amet consectetur adipiscing elit</div>
                        </div>
                    </div>
                    <div class="search">
                        <form action="{{ URL::to('/search') }}">
                            <input class="form-control" type="text" placeholder="Looking for something?" />
                            <button type="submit"><img src="{{ asset('images/search.png') }}" alt="" title=""/></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="bg-find">
                <div class="t-find">Find Your Vehicle</div>
                <form>
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <div class="form-group">
                                <label for="brand">Select Brand:</label>
                                <div class="css-select">
                                    <select name="brand" class="form-control" id="brand" required="">
                                        <option selected="" disabled="">All Brands</option>
                                        <option value="BMW">BMW</option>
                                        <option value="Honda">Honda</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="form-group">
                                <label for="brand">Select Model:</label>
                                <div class="css-select">
                                    <select name="brand" class="form-control" id="brand" required="">
                                        <option selected="" disabled="">All Models</option>
                                        <option value="Class CLA180">Class CLA180</option>
                                        <option value="Class 123">Class 123</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="form-group">
                                <label for="brand">Select Transmission Type:</label>
                                <div class="css-select">
                                    <select name="brand" class="form-control" id="brand" required="">
                                        <option selected="" disabled="">All Types</option>
                                        <option value="AT">AT</option>
                                        <option value="MT">MT</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
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
                    <div class="col-md-4 col-lg-3 xs20">
                        <div class="t-brand">Our Brands</div>
                        <div class="clearfix">
                            <ul class="l-brand">
                                <li>
                                    <a href="#" class="active">
                                        <div>Toyota</div>
                                        <div class="img"><img src="{{ asset('images/arrow-brand.png') }}" alt="" title=""/></div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div>Toyota</div>
                                        <div class="img"><img src="{{ asset('images/arrow-brand.png') }}" alt="" title=""/></div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div>Toyota</div>
                                        <div class="img"><img src="{{ asset('images/arrow-brand.png') }}" alt="" title=""/></div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div>Toyota</div>
                                        <div class="img"><img src="{{ asset('images/arrow-brand.png') }}" alt="" title=""/></div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div>Toyota</div>
                                        <div class="img"><img src="{{ asset('images/arrow-brand.png') }}" alt="" title=""/></div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div>Toyota</div>
                                        <div class="img"><img src="{{ asset('images/arrow-brand.png') }}" alt="" title=""/></div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div>Toyota</div>
                                        <div class="img"><img src="{{ asset('images/arrow-brand.png') }}" alt="" title=""/></div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <div>Toyota</div>
                                        <div class="img"><img src="{{ asset('images/arrow-brand.png') }}" alt="" title=""/></div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-9">
                        <div class="row row-15">
                            <div class="col-md-6 col-lg-4">
                                <div class="item">
                                    <a href="{{ URL::to('/product-listing-detail') }}">
                                        <div class="pos-rel">
                                            <div class="img"><img src="{{ asset('images/product.jpg') }}" alt="" title=""/></div>
                                            <div class="abs">Reserved</div>
                                        </div>
                                        <div class="pad">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="year">2015</div>
                                                    <div class="nm">Mercedes-Benz</div> <div class="merk">Class CLA180</div>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="price">$30,000</div>
                                                    <div class="stock">Stock # 48595896</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="item">
                                    <a href="{{ URL::to('/product-listing-detail') }}">
                                        <div class="pos-rel">
                                            <div class="img"><img src="{{ asset('images/product.jpg') }}" alt="" title=""/></div>
                                            <div class="abs">Reserved</div>
                                        </div>
                                        <div class="pad">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="year">2015</div>
                                                    <div class="nm">Mercedes-Benz</div> <div class="merk">Class CLA180</div>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="price">$30,000</div>
                                                    <div class="stock">Stock # 48595896</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="item">
                                    <a href="{{ URL::to('/product-listing-detail') }}">
                                        <div class="pos-rel">
                                            <div class="img"><img src="{{ asset('images/product.jpg') }}" alt="" title=""/></div>
                                            <div class="abs">Reserved</div>
                                        </div>
                                        <div class="pad">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="year">2015</div>
                                                    <div class="nm">Mercedes-Benz</div> <div class="merk">Class CLA180</div>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="price">$30,000</div>
                                                    <div class="stock">Stock # 48595896</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="item">
                                    <a href="{{ URL::to('/product-listing-detail') }}">
                                        <div class="pos-rel">
                                            <div class="img"><img src="{{ asset('images/product.jpg') }}" alt="" title=""/></div>
                                            <div class="abs">Reserved</div>
                                        </div>
                                        <div class="pad">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="year">2015</div>
                                                    <div class="nm">Mercedes-Benz</div> <div class="merk">Class CLA180</div>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="price">$30,000</div>
                                                    <div class="stock">Stock # 48595896</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="item">
                                    <a href="{{ URL::to('/product-listing-detail') }}">
                                        <div class="pos-rel">
                                            <div class="img"><img src="{{ asset('images/product.jpg') }}" alt="" title=""/></div>
                                            <div class="abs">Reserved</div>
                                        </div>
                                        <div class="pad">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="year">2015</div>
                                                    <div class="nm">Mercedes-Benz</div> <div class="merk">Class CLA180</div>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="price">$30,000</div>
                                                    <div class="stock">Stock # 48595896</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="item">
                                    <a href="{{ URL::to('/product-listing-detail') }}">
                                        <div class="pos-rel">
                                            <div class="img"><img src="{{ asset('images/product.jpg') }}" alt="" title=""/></div>
                                            <div class="abs">Reserved</div>
                                        </div>
                                        <div class="pad">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="year">2015</div>
                                                    <div class="nm">Mercedes-Benz</div> <div class="merk">Class CLA180</div>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="price">$30,000</div>
                                                    <div class="stock">Stock # 48595896</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="item">
                                    <a href="{{ URL::to('/product-listing-detail') }}">
                                        <div class="pos-rel">
                                            <div class="img"><img src="{{ asset('images/product.jpg') }}" alt="" title=""/></div>
                                            <div class="abs">Reserved</div>
                                        </div>
                                        <div class="pad">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="year">2015</div>
                                                    <div class="nm">Mercedes-Benz</div> <div class="merk">Class CLA180</div>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="price">$30,000</div>
                                                    <div class="stock">Stock # 48595896</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="item">
                                    <a href="{{ URL::to('/product-listing-detail') }}">
                                        <div class="pos-rel">
                                            <div class="img"><img src="{{ asset('images/product.jpg') }}" alt="" title=""/></div>
                                            <div class="abs">Reserved</div>
                                        </div>
                                        <div class="pad">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="year">2015</div>
                                                    <div class="nm">Mercedes-Benz</div> <div class="merk">Class CLA180</div>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="price">$30,000</div>
                                                    <div class="stock">Stock # 48595896</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4">
                                <div class="item">
                                    <a href="{{ URL::to('/product-listing-detail') }}">
                                        <div class="pos-rel">
                                            <div class="img"><img src="{{ asset('images/product.jpg') }}" alt="" title=""/></div>
                                            <div class="abs">Reserved</div>
                                        </div>
                                        <div class="pad">
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="year">2015</div>
                                                    <div class="nm">Mercedes-Benz</div> <div class="merk">Class CLA180</div>
                                                </div>
                                                <div class="col-6 text-right">
                                                    <div class="price">$30,000</div>
                                                    <div class="stock">Stock # 48595896</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
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
                            <a class="click-register">
                                <button type="button" class="hvr-button full100">GSign up and start dealing now.</button>
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
            min: 30000,
            max: 200000,
            step: 10000,
            values: [ 30000, 100000 ],
            slide: function( event, ui ) {
                $( "#amount-1" ).val( "$ " + numberThousand(ui.values[ 0 ]));
                $( "#amount-2" ).val( "$ " + numberThousand(ui.values[ 1 ]))
            }
        });

        function numberThousand(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        $( "#amount-1" ).val( "$ " + numberThousand($( "#slider-range" ).slider( "values", 0 )));
        $( "#amount-2" ).val( "$ " + numberThousand($( "#slider-range" ).slider( "values", 1 )));
	});
</script>
@endsection