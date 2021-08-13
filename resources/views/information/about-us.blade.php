@extends('layout')

@section('content')
    <div class="pad-content">
        <div class="css-about">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8">
                        <div class="title">About Us</div>
                        <div class="bdy">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pharetra, proin auctor dolor tellus laoreet diam tristique. Nunc dictum velit diam a, bibendum eu, gravida est. Pellentesque nunc diam accumsan sapien adipiscing ullamcorper odio lobortis.</p>
                        </div>
                    </div>
                </div>
                <div class="mb150">
                    <div class="row justify-content-center">
                        <div class="col-lg-11 col-xl-10">
                            <div class="row row30">
                                <div class="col-md-6 my-auto">
                                    <div class="img bg1">
                                        <img src="{{ asset('images/about1.jpg') }}" alt="" title=""/>
                                    </div>
                                </div>
                                <div class="col-md-6 my-auto">
                                    <div class="t1">Our Story</div>
                                    <div class="desc">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pharetra, proin auctor dolor tellus laoreet diam tristique. Nunc dictum velit diam a, bibendum eu, gravida est. Pellentesque nunc diam accumsan sapien adipiscing ullamcorper odio lobortis. Pellentesque nunc diam accumsan sapien adipiscing ullamcorper odio lobortis. Pellentesque nunc diam accumsan sapien adipiscing ullamcorper odio lobortis. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="row row30">
                                <div class="col-md-6 my-auto order-2 order-md-1">
                                    <div class="t1">Our Values</div>
                                    <div class="desc">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pharetra, proin auctor dolor tellus laoreet diam tristique. Nunc dictum velit diam a, bibendum eu, gravida est. Pellentesque nunc diam accumsan sapien adipiscing ullamcorper odio lobortis. Pellentesque nunc diam accumsan sapien adipiscing ullamcorper odio lobortis. Pellentesque nunc diam accumsan sapien adipiscing ullamcorper odio lobortis. </p>
                                    </div>
                                </div>
                                <div class="col-md-6 my-auto order-1 order-md-2">
                                    <div class="img bg2">
                                        <img src="{{ asset('images/about2.jpg') }}" alt="" title=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="t1 mb10">Lorem Ipsum</div>
                <div class="row row30">
                    <div class="col-md-6 my-auto">
                        <div class="img">
                            <img src="{{ asset('images/about3.jpg') }}" alt="" title=""/>
                        </div>
                    </div>
                    <div class="col-md-6 my-auto">
                        <div class="desc">
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Imperdiet in etiam quis venenatis. Egestas nec eu, massa diam in quam aliquam. Odio gravida vitae et venenatis sed. Id accumsan et massa gravida. Duis mauris posuere eu ultrices dictumst at bibendum. Et enim viverra quam ut. Id arcu faucibus nisl justo, nunc, hac. Sed etiam sed risus neque sed ut aliquam viverra.</p><br/>
                            <p>Bibendum arcu augue ac at at lorem ullamcorper tincidunt. Vestibulum velit pellentesque cras sit amet, vitae integer risus. Morbi porttitor neque bibendum interdum eu, id mauris eget est. Quam luctus phasellus tempor, purus pulvinar nibh lacus, non convallis. A rhoncus ultricies massa pretium dignissim. Sem neque aliquam curabitur mattis leo, purus viverra ut fames. Mattis metus eu viverra vitae odio leo blandit nulla eget. Urna tortor auctor a amet adipiscing arcu. Ultricies nisi et bibendum quis malesuada ultricies. Dui scelerisque ipsum risus fringilla sagittis, tristique. Diam dolor commodo, tellus quisque magna.</p><br/>
                            <p>Vel a a ut quisque nunc, dapibus dui gravida ut. Sagittis viverra amet turpis suscipit eu pharetra molestie. Dolor, elementum vel pulvinar at fermentum duis. Arcu, risus urna, feugiat commodo non aenean. Nullam consectetur lacus, mollis elit auctor egestas eleifend augue a. Interdum bibendum euismod diam etiam sit elit lorem in.</p>
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
		$('.nav-about').addClass('active');
	});
</script>
@endsection