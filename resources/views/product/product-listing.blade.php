@extends('layout')

@section('content')

    <div class="pad-content">
        <div class="css-product">
            <div class="container">
                <div class="title">Find Your Vehicle</div>
                <div class="row">
                    <div class="col-md-4 col-lg-3 xs30">
                        <div class="t3">Price Range</div>
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
                        <div class="mb10">
                            <button type="button" class="hvr-button full100">Search Inventory</button>
                        </div>
                        <div class="click-reset">
                            <button type="button" class="hvr-button full100">Clear Filters</button>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-9">
                        <div class="t2">25 Matches</div>
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
                        <ul class="l-pagination">
                            <li><a><i class="fas fa-chevron-left"></i> Prev</a></li>
                            <li><a>1</a></li>
                            <li><a class="active">2</a></li>
                            <li><a>3</a></li>
                            <li><a>...</a></li>
                            <li><a>6</a></li>
                            <li><a>Next <i class="fas fa-chevron-right"></i></a></li>
                        </ul>
                        <!--
                        <div class="banner" style="background: url('images/banner-product.jpg') no-repeat center;">
                            <div class="t-banner">Lorem ipsum dolor sit amet conseactetur</div>
                            <div class="link">
                                <a href="{{ URL::to('/contact-us') }}">
                                    <button type="button" class="hvr-button">Get Quote</button>
                                </a>
                            </div>
                        </div>
                        -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function() {
        $('.nav-product').addClass('active');

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

        $(".click-reset").on("click", function () {
            $('.css-select select option').prop('selected', function() {
                return this.defaultSelected;
            });
        });
	});
</script>
@endsection