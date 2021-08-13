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
                        <div>
                            <button type="button" class="hvr-button full100">Clear Filters</button>
                        </div>
                    </div>
                    <div class="col-md-8 col-lg-9">
                        <div class="box-search">
                            <div class="row">
                                <div class="col-md-6 col-lg-7">
                                    <div class="t2">25 Matches</div>
                                    <div class="t-search">Search : <span class="bold">Mercedes-Benz"</span></div>
                                </div>
                                <div class="col-md-6 col-lg-5">
                                    <div class="search">
                                        <form action="{{ URL::to('/search') }}">
                                            <input class="form-control" type="text" placeholder="Looking for something?" />
                                            <button type="submit"><img src="{{ asset('images/search2.png') }}" alt="" title=""/></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="t-empty">There's no product in this category.</div>
                        <div class="banner" style="background: url('images/banner-product.jpg') no-repeat center;">
                            <div class="t-banner">Lorem ipsum dolor sit amet conseactetur</div>
                            <div class="link">
                                <a href="{{ URL::to('/contact-us') }}">
                                    <button type="button" class="hvr-button">Get Quote</button>
                                </a>
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
	});
</script>
@endsection