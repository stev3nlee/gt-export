@extends('layout')

@section('content')
    <div class="pad-content">
        <div class="css-about">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8">
                        <div class="title">{{ $about->title }}</div>
                        <div class="bdy">
                            {!! $about->content !!}
                        </div>
                    </div>
                </div>
                <div class="mb150">
                    <div class="row justify-content-center">
                        <div class="col-lg-11 col-xl-10">
                            <div class="row row30">
                                <div class="col-md-6 my-auto">
                                    <div class="img bg1">
                                        <img src="{{ asset('upload/'.$story->image) }}" alt="" title=""/>
                                    </div>
                                </div>
                                <div class="col-md-6 my-auto">
                                    <div class="t1">{{ $story->title }}</div>
                                    <div class="desc">
                                        {!! $story->content !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row row30">
                                <div class="col-md-6 my-auto order-2 order-md-1">
                                    <div class="t1">{{ $our_value->title }}</div>
                                    <div class="desc">
                                         {!! $our_value->content !!}
                                    </div>
                                </div>
                                <div class="col-md-6 my-auto order-1 order-md-2">
                                    <div class="img bg2">
                                        <img src="{{ asset('upload/'.$our_value->image) }}" alt="" title=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="t1 mb10">{{ $etc->title }}</div>
                <div class="row row30">
                    <div class="col-md-6 my-auto">
                        <div class="img">
                            <img src="{{ asset('upload/'.$etc->image) }}" alt="" title=""/>
                        </div>
                    </div>
                    <div class="col-md-6 my-auto">
                        <div class="desc">
                            {!! $etc->content !!}
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