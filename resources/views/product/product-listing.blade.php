@extends('layout')

@section('content')

    <div class="pad-content">
        <div class="css-product">
            <div class="container">
                <div class="title">Find Your Vehicle</div>
                <div class="row">
                    <div class="col-md-4 col-lg-3 xs30">
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
                        <?php /* ?>
                        <div class="form-group">
                            <label for="brand">Product Category Type:</label>
                            <div class="css-select">
                                <select name="category_type" class="form-control" id="category_type" required="">
                                    <option selected="" disabled="">All Types</option>
                                    <option value="all" @if($category_type == 'all') selected @endif >All Cars</option>
                                    <option value="newly" @if($category_type == 'newly') selected @endif >Newly Added</option>
                                    <option value="clearance" @if($category_type == 'clearance') selected @endif >Clearance Section</option>
                                </select>
                            </div>
                        </div>
                        <?php */ ?>
                        <div class="form-group">
                            <label for="brand">Select Brand:</label>
                            <div class="css-select">
                                <select name="brand" class="form-control" id="brand" required="">
                                    <option selected="" disabled="">All Brands</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->slug }}" @if($brand_select == $brand->slug) selected @endif>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="brand">Select Model:</label>
                            <div class="css-select">
                                <select name="model" class="form-control" id="brand" required="">
                                    <option selected="" disabled="">All Models</option>
                                    @foreach($models as $model)
                                        <option value="{{ $model->slug }}" @if($model_select == $model->slug) selected @endif>{{ $model->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="brand">Select Transmission Type:</label>
                            <div class="css-select">
                                <select name="transmission" class="form-control" id="brand" required="">
                                    <option selected="" disabled="">All Types</option>
                                    @foreach($transmissions as $transmission)
                                        <option value="{{ $transmission->slug }}" @if($transmission_select == $transmission->slug) selected @endif>{{ $transmission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb10">
                            <button type="submit" class="hvr-button full100">Search Inventory</button>
                        </div>
                        <div class="click-reset">
                            <button type="button" class="hvr-button full100">Clear Filters</button>
                        </div>
                        </form>
                    </div>
                    <div class="col-md-8 col-lg-9">
                        <div class="box-search">
                            <div class="row">
                                <div class="col-md-6 col-lg-7">
                                    <div class="t2">{{ $products->total() }} Matches</div>
                                    @if($search)
                                    <div class="t-search">Search : <span class="bold">{{ $search }}</span></div>
                                    @endif
                                </div>
                                <div class="col-md-6 col-lg-5">
                                    <div class="search">
                                        <form action="{{ url('product-listing') }}">
                                            <input class="form-control" name="search" type="text" placeholder="Looking for something?" />
                                            <button type="submit"><img src="{{ asset('images/search2.png') }}" alt="" title=""/></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(count($products)>0)
                        <div class="row row-15">
                            @foreach($products as $product)
                            <div class="col-md-3 col-lg-3">
                                <div class="item">
                                    <div class="pos-rel">                                        
                                        <div class="img">@if(isset($product->product_image[0]))<img src="{{ asset($product->thumbnail) }}" alt="" title=""/>@endif</div>
                                        @if($product->reserve == 1)
                                            <div class="abs">Reserved</div>
                                            <div class="abs">New Arrival</div>
                                        @elseif($product->reserve == 2)
                                            <div class="abs">Sold</div>
                                            <div class="abs">New Arrival</div>
                                        @elseif($product->new_arrival_expired_date != null)
                                            <div class="abs">New Arrival</div>
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
                                                    <div class="nm">@if(isset($product->brand[0])) {{ $product->brand[0]->name }} @endif</div> <div class="merk">Class {{ $product->product_type }}</div>
                                                </div>
                                                <div class="col-6 text-right">
                                                    @if($product->price && $product->reserve == 0)
                                                    <div class="price">${{ number_format($product->price, 2, '.', ',') }}</div>
                                                    <div class="price">$ {{ number_format($product->price, 2, ',', '.') }} You save 20%</div>
                                                    @endif
                                                    <div class="stock">Stock # {{ $product->stock }}</div>
                                                </div>
                                            </div>
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
            min: 30000,
            max: 200000,
            step: 10000,
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
	});
</script>
@endsection