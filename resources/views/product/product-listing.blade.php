@extends('layout')

@section('content')

    <div class="pad-content">
        <div class="css-product">
            <div class="container">
                <div class="title">Find Your Vehicle</div>
                <div class="row">
                    <div class="col-md-3 xs30">
                    <form>
                        <div class="t3">Price Range</div>
                        <div class="row">
                            <div class="col-6 my-auto">
                                <input class="bdr-range" type="text" id="amount-1" readonly name="">
                            </div>
                            <div class="col-6 my-auto text-right">
                                <input class="bdr-range" type="text" id="amount-2" readonly name="">
                            </div>
                        </div>
                        <input type="hidden" name="range_min" id="range-min">
                        <input type="hidden" name="range_max" id="range-max">
                        <div class="pad-range">
                            <div id="slider-range"></div>
                        </div>
                        <div class="form-group">
                            <label for="brand">Product Category Type:</label>
                            <div class="css-select">
                                <select name="category_type" class="form-control" id="category_type">
                                    <option selected="" value="">All Types</option>
                                    <option value="all" @if($category_type == 'all') selected @endif >All Cars</option>
                                    <option value="newly" @if($category_type == 'newly') selected @endif >Newly Added</option>
                                    <option value="clearance" @if($category_type == 'clearance') selected @endif >Clearance Section</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="brand">Select Brand:</label>
                            <div class="css-select">
                                <select name="brand" class="form-control" id="select-brand">
                                    <option selected="" value="">All Brands</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->slug }}" @if($brand_select == $brand->slug) selected @endif>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="model">Select Model:</label>
                            <div class="css-select">
                                <select name="model" class="form-control" id="model">
                                    <option selected="" value="">All Models</option>
                                    @foreach($models as $model)
                                        <option value="{{ $model->slug }}" @if($model_select == $model->slug) selected @endif>{{ $model->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="brand">Select Transmission Type:</label>
                            <div class="css-select">
                                <select name="transmission" class="form-control" id="brand">
                                    <option selected="" value="">All Types</option>
                                    @foreach($transmissions as $transmission)
                                        <option value="{{ $transmission->slug }}" @if($transmission_select == $transmission->slug) selected @endif>{{ $transmission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="brand">Select Car Type:</label>
                            <div class="css-select">
                                <?php $types = array('Bus','Bus 20 Seats','Convertible','Coupe','Hatchback','Mini Bus','Mini Van','Mini Vehicle','Pick Up','Sedan','SUV','Truck','Van','Wagon','Forklift','Machinery','Tractor') ?>
                                    <select name="car_type" class="form-control" id="car_type">
                                        <option selected="" value="">All Types</option>
                                        @foreach($types as $type)
                                        <option value="{{ $type }}"  @if($car_type == $type) selected @endif>{{ $type }}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="brand">Select Fuel Type:</label>
                            <div class="css-select">
                                    <?php $fuels = array('CNG','Diesel','Electric','Hybrid (Diesel)','Hybrid (Petrol)','LPG','Other','Petrol') ?>
                                    <select name="fuel" class="form-control" id="car_type">
                                        <option selected="" value="">All Fuel Types</option>
                                        @foreach($fuels as $fuel_type)
                                        <option value="{{ $fuel_type }}"  @if($fuel == $fuel_type) selected @endif>{{ $fuel_type }}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="brand">Select Colour:</label>
                            <div class="css-select">
                                    <?php $colors = array('Beige','Black','Blue','Bronze','Brown','Gold','Gray','Green','Maroon','Orange','Pearl','Pink','Purple','Red','Silver','White','Yellow','Other') ?>
                                    <select name="colour" class="form-control" id="car_type">
                                        <option selected="" value="">All Colours</option>
                                        @foreach($colors as $color_type)
                                        <option value="{{ $color_type }}"  @if($color == $color_type) selected @endif>{{ $color_type }}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="brand">Select Drivetrain:</label>
                            <div class="css-select">
                                    <select name="drivetrain" class="form-control" id="car_type">
                                        <option selected="" value="">All Types</option>
                                        <option value="2WD" @if($drivetrain == '2WD') selected @endif>2WD</option>
                                        <option value="4WD" @if($drivetrain == '4WD') selected @endif>4WD</option>
                                    </select>
                            </div>
                        </div>
                        <div class="form-group mb15">
                            <div class="row">
                                <div class="col-6">
                                    <label for="brand">Min Year:</label>
                                    <div class="css-select">
                                        <select name="min_year" class="form-control" id="car_type">
                                            <option selected="" value="">Select Year</option>
                                            {{ $last= date('Y')-16 }}
                                            {{ $now = date('Y') }}
                                            @for ($i = $now; $i >= $last; $i--)
                                                <option value="{{ $i }}" @if($min_year == $i) selected @endif>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="brand">Max Year:</label>
                                    <div class="css-select">
                                        <select name="max_year" class="form-control" id="car_type">
                                            <option selected="" value="">Select Year</option>
                                            {{ $last= date('Y')-16 }}
                                            {{ $now = date('Y') }}
                                            @for ($i = $now; $i >= $last; $i--)
                                                <option value="{{ $i }}" @if($max_year == $i) selected @endif>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input name="sort" type="hidden" value="{{ $sort }}" />
                        <!-- <input type="hidden" name="search" value="{{ $search }}"> -->
                        <div class="click-reset mb10">
                            <button type="button" class="hvr-button full100"  onclick="location.href='{{ url('product-listing') }}'">Clear Filters</button>
                        </div>
                        <div class="mb10">
                            <button type="submit" class="hvr-button full100">Search Inventory</button>
                        </div>
                        </form>
                    </div>
                    <div class="col-md-9">
                        <div class="box-search">
                            <div class="row">
                                <div class="col-md-6 col-lg-8">
                                    <div class="t-match">{{ $products->total() }} Matches</div>
                                    @if($search)
                                    <div class="t-search">Search : <span class="bold">{{ $search }}</span></div>
                                    @endif
                                </div>
                                <div class="col-md-6 col-lg-4">
                                    <div class="css-select">
                                    <form action="{{ url()->current() }}">
                                        <select onChange="this.form.submit()" name="sort" class="form-control stocklist-select" id="sort">
                                            <option selected="" value="">Sort By</option>
                                            <option value="high-low" @if($sort == 'high-low') selected @endif>Price High to Low</option>
                                            <option value="low-high" @if($sort == 'low-high') selected @endif>Price Low to High</option>
                                            <option value="new" @if($sort == 'new') selected @endif>Newly Added</option>
                                            <option value="disc-high" @if($sort == 'disc-high') selected @endif>Discount % High to Low</option>
                                            <option value="disc-low" @if($sort == 'disc-low') selected @endif>Discount % Low to High</option>
                                            <option value="year-new" @if($sort == 'year-new') selected @endif>New to Old</option>
                                            <option value="year-old" @if($sort == 'year-old') selected @endif>Old to New</option>
                                            <option value="engine-high" @if($sort == 'engine-high') selected @endif>Engine High to Low</option>
                                            <option value="engine-low" @if($sort == 'engine-low') selected @endif>Engine Low to High</option>
                                            <option value="mileage-high" @if($sort == 'mileage-high') selected @endif>Mileage High to Low</option>
                                            <option value="mileage-low" @if($sort == 'mileage-low') selected @endif>Mileage Low to High</option>
                                        </select>
                                        <input name="range_min" type="hidden" value="{{ $range_min }}" />
                                        <input name="range_max" type="hidden" value="{{ $range_max }}" />
                                        <input name="category_type" type="hidden" value="{{ $category_type }}" />
                                        <input name="brand" type="hidden" value="{{ $brand_select }}" />
                                        <input name="model" type="hidden" value="{{ $model_select }}" />
                                        <input name="transmission" type="hidden" value="{{ $transmission_select }}" />
                                        <input name="car_type" type="hidden" value="{{ $car_type }}" />
                                        <input name="fuel" type="hidden" value="{{ $fuel }}" />
                                        <input name="colour" type="hidden" value="{{ $color }}" />
                                        <input name="drivetrain" type="hidden" value="{{ $drivetrain }}" />
                                        <input name="min_year" type="hidden" value="{{ $min_year }}" />
                                        <input name="max_year" type="hidden" value="{{ $max_year }}" />
                                    </form>
                                    </div>
                                    <!-- <div class="search">
                                        <form action="{{ url('product-listing') }}">
                                            <input name="range_min" type="hidden" value="{{ $range_min }}" />
                                            <input name="range_max" type="hidden" value="{{ $range_max }}" />
                                            <input name="category_type" type="hidden" value="{{ $category_type }}" />
                                            <input name="brand" type="hidden" value="{{ $brand_select }}" />
                                            <input name="model" type="hidden" value="{{ $model_select }}" />
                                            <input name="transmission" type="hidden" value="{{ $transmission_select }}" />
                                            <input name="car_type" type="hidden" value="{{ $car_type }}" />
                                            <input class="form-control" name="search" type="text" placeholder="Looking for something?" />
                                            <button type="submit"><img src="{{ asset('images/search2.png') }}" alt="" title=""/></button>
                                        </form>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        @if(count($products)>0)
                        <div class="row row-15">
                            @foreach($products as $product)
                            <div class="col-6 col-md-4 col-xl-3 mb15">
                                <div class="item">
                                    <div class="pos-rel">                   
                                        <div class="img">@if(isset($product->product_image[0]))<img src="{{ asset($product->product_image[0]->image) }}" alt="" title=""/>@endif</div>
                                        @if($product->reserve == 1)
                                            <div class="abs">Reserved</div>
                                        @elseif($product->reserve == 2)
                                            <div class="abs">Sold</div>
                                        @endif
                                        @if($product->new_arrival_expired_date != null)
                                            <div class="new">New Arrival</div>
                                        @endif
                                        <?php /* ?>
                                        @if($product->reserve == 0)
                                        <div class="abs-get">
                                        @if(session()->has('email'))
                                            <a style="cursor: pointer;" class="click-submit-quote" data-product="{{ $product->slug }}">Get Quote</a>
                                        @else
                                            <a style="cursor: pointer;" class="click-submit-quote-guest" data-product="{{ $product->slug }}">Get Quote</a>
                                        @endif
                                        </div>
                                        @endif
                                        <?php */ ?>
                                    </div>
                                    <a href="{{ URL::to('/product-listing-detail/'.$product->slug) }}">
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
                            @endforeach
                        </div>
                        
                        
                        @if ($products->hasPages())
                        <ul class="l-pagination">
                            {{-- Previous Page Link --}}
                            @if ($products->onFirstPage())
                                <li class="disabled"><a><i class="fas fa-chevron-left"></i> Prev</a></li>
                            @else
                                <li><a href="{{ $products->previousPageUrl() }}" ><i class="fas fa-chevron-left"></i> Prev</a></li>
                            @endif

                            @if($products->currentPage() > 3)
                                <li><a href="{{ $products->url(1) }}">1</a></li>
                            @endif
                            @if($products->currentPage() > 4)
                                <li><a>...</a></li>
                            @endif
                            @foreach(range(1, $products->lastPage()) as $i)
                                @if($i >= $products->currentPage() - 2 && $i <= $products->currentPage() + 2)
                                    @if ($i == $products->currentPage())
                                        <li><a class="active">{{ $i }}</a></li>
                                    @else
                                        <li><a href="{{ $products->url($i) }}">{{ $i }}</a></li>
                                    @endif
                                @endif
                            @endforeach
                            @if($products->currentPage() < $products->lastPage() - 3)
                                <li><a>...</a></li>
                            @endif
                            @if($products->currentPage() < $products->lastPage() - 2)
                                <li><a href="{{ $products->url($products->lastPage()) }}">{{ $products->lastPage() }}</a></li>
                            @endif

                            {{-- Next Page Link --}}
                            @if ($products->hasMorePages())
                                <li><a href="{{ $products->nextPageUrl() }}">Next <i class="fas fa-chevron-right"></i></a></li>
                            @else
                                <li class="disabled"><a>Next <i class="fas fa-chevron-right"></i></a></li>
                            @endif
                        </ul>
                        @endif
                        @else
                        <div class="t-empty">There's no product in this category.</div>
                        @endif
                        <!-- <div class="banner" style="background: url('images/banner-product.jpg') no-repeat center;">
                            <div class="t-banner">Lorem ipsum dolor sit amet conseactetur</div>
                            <div class="link">
                                <a href="{{ URL::to('/contact-us') }}">
                                    <button type="button" class="hvr-button">Get Quote</button>
                                </a>
                            </div>
                        </div> -->
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
            min: 0,
            max: {{ $highest_price }},
            step: 1,
            values: [ {{ $range_min }}, {{ $range_max }} ],
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

        $( "#amount-1" ).val( "$ " + numberThousand({{ $range_min }}));
        $( "#amount-2" ).val( "$ " + numberThousand({{ $range_max }}));
        $( "#range-min" ).val( $( "#slider-range" ).slider( "values", 0 ));
        $( "#range-max" ).val( $( "#slider-range" ).slider( "values", 1 ));

        $(".click-reset").on("click", function () {
            $('.css-select select option').prop('selected', function() {
                return this.defaultSelected;
            });
            window.location = "{{ url('product-listing') }}";
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