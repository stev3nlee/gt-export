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
                        <div class="merk">Porsche</div>
                        <div class="nm">{{ $product->name }}</div>
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
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. A gravida tempor tristique dignissim velit. Ut ante ultrices lectus arcu id leo.</p>
                                <p>Eget vulputate enim tellus non facilisis congue amet nisl. Aliquam sed enim mattis interdum sollicitudin sit pulvinar urna.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="t1">Car Details</div>
            <div class="t2">Economy & Performance</div>
            <div class="row text1">
                <div class="col-md-6">
                    <div class="mb15">
                        <div class="row">
                            <div class="col-6 my-auto"><div class="bold">Engine Power</div></div>
                            <div class="col-6 my-auto">190 bhp</div>
                        </div>
                    </div>
                    <div class="mb15">
                        <div class="row">
                            <div class="col-6 my-auto"><div class="bold">Engine Power</div></div>
                            <div class="col-6 my-auto">190 bhp</div>
                        </div>
                    </div>
                    <div class="mb15">
                        <div class="row">
                            <div class="col-6 my-auto"><div class="bold">Engine Power</div></div>
                            <div class="col-6 my-auto">190 bhp</div>
                        </div>
                    </div>
                    <div class="mb15">
                        <div class="row">
                            <div class="col-6 my-auto"><div class="bold">Engine Power</div></div>
                            <div class="col-6 my-auto">190 bhp</div>
                        </div>
                    </div>
                    <div class="mb15">
                        <div class="row">
                            <div class="col-6 my-auto"><div class="bold">Engine Power</div></div>
                            <div class="col-6 my-auto">190 bhp</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb15">
                        <div class="row">
                            <div class="col-6 my-auto"><div class="bold">Engine Power</div></div>
                            <div class="col-6 my-auto">190 bhp</div>
                        </div>
                    </div>
                    <div class="mb15">
                        <div class="row">
                            <div class="col-6 my-auto"><div class="bold">Engine Power</div></div>
                            <div class="col-6 my-auto">190 bhp</div>
                        </div>
                    </div>
                    <div class="mb15">
                        <div class="row">
                            <div class="col-6 my-auto"><div class="bold">Engine Power</div></div>
                            <div class="col-6 my-auto">190 bhp</div>
                        </div>
                    </div>
                    <div class="mb15">
                        <div class="row">
                            <div class="col-6 my-auto"><div class="bold">Engine Power</div></div>
                            <div class="col-6 my-auto">190 bhp</div>
                        </div>
                    </div>
                    <div class="mb15">
                        <div class="row">
                            <div class="col-6 my-auto"><div class="bold">Engine Power</div></div>
                            <div class="col-6 my-auto">190 bhp</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bdr"></div>
            <div class="t2">Exterior Features</div>
            <div class="row text2">
                <div class="col-md-4">
                    <div class="pos-rel mb15">
                        <div class="abs"><img src="{{ asset('images/correct.png') }}" alt="" title=""/></div>
                        <div class="t"> Glass - Rear Windows heated with Timer Control</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pos-rel mb15">
                        <div class="abs"><img src="{{ asset('images/correct.png') }}" alt="" title=""/></div>
                        <div class="t"> Glass - Rear Windows heated with Timer Control</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pos-rel mb15">
                        <div class="abs"><img src="{{ asset('images/correct.png') }}" alt="" title=""/></div>
                        <div class="t"> Glass - Rear Windows heated with Timer Control</div>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="pos-rel mb15">
                        <div class="abs"><img src="{{ asset('images/correct.png') }}" alt="" title=""/></div>
                        <div class="t"> Glass - Rear Windows heated with Timer Control</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pos-rel mb15">
                        <div class="abs"><img src="{{ asset('images/correct.png') }}" alt="" title=""/></div>
                        <div class="t"> Glass - Rear Windows heated with Timer Control</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pos-rel mb15">
                        <div class="abs"><img src="{{ asset('images/correct.png') }}" alt="" title=""/></div>
                        <div class="t"> Glass - Rear Windows heated with Timer Control</div>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="pos-rel mb15">
                        <div class="abs"><img src="{{ asset('images/correct.png') }}" alt="" title=""/></div>
                        <div class="t"> Glass - Rear Windows heated with Timer Control</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pos-rel mb15">
                        <div class="abs"><img src="{{ asset('images/correct.png') }}" alt="" title=""/></div>
                        <div class="t"> Glass - Rear Windows heated with Timer Control</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pos-rel mb15">
                        <div class="abs"><img src="{{ asset('images/correct.png') }}" alt="" title=""/></div>
                        <div class="t"> Glass - Rear Windows heated with Timer Control</div>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="pos-rel mb15">
                        <div class="abs"><img src="{{ asset('images/correct.png') }}" alt="" title=""/></div>
                        <div class="t"> Glass - Rear Windows heated with Timer Control</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pos-rel mb15">
                        <div class="abs"><img src="{{ asset('images/correct.png') }}" alt="" title=""/></div>
                        <div class="t"> Glass - Rear Windows heated with Timer Control</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pos-rel mb15">
                        <div class="abs"><img src="{{ asset('images/correct.png') }}" alt="" title=""/></div>
                        <div class="t"> Glass - Rear Windows heated with Timer Control</div>
                    </div>
                </div>
                 <div class="col-md-4">
                    <div class="pos-rel mb15">
                        <div class="abs"><img src="{{ asset('images/correct.png') }}" alt="" title=""/></div>
                        <div class="t"> Glass - Rear Windows heated with Timer Control</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pos-rel mb15">
                        <div class="abs"><img src="{{ asset('images/correct.png') }}" alt="" title=""/></div>
                        <div class="t"> Glass - Rear Windows heated with Timer Control</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pos-rel mb15">
                        <div class="abs"><img src="{{ asset('images/correct.png') }}" alt="" title=""/></div>
                        <div class="t"> Glass - Rear Windows heated with Timer Control</div>
                    </div>
                </div>
            </div>
            <div class="bdr"></div>
            <div class="t2">Technical</div>
            <div class="text3">
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb15">Power Steering</div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb15">Power Steering</div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb15">Power Steering</div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb15">Power Steering</div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb15">Power Steering</div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb15">Power Steering</div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb15">Power Steering</div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb15">Power Steering</div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb15">Power Steering</div>
                    </div>
                </div>
            </div>
            <div class="bdr"></div>
        </div>
        <div class="banner" style="background: url('images/banner-detail.jpg') no-repeat center;">
            <div class="container">
                <div class="t-banner">Interested?</div>
                <div class="bdy-banner">
                    <p>Get in touch with our sales partner for more information.</p>
                </div>
                <div class="link">
                    <a href="">
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