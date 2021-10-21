@extends('layout')

@section('content')
    <div class="pad-content">
        <div class="css-faq">
            <div class="container">
                <div class="title">Frequently Asked Questions</div>
                <div class="bdy">
                    <!--<p>Regulation details for all our destination countries</p>-->
                </div>
                <div class="controls">
                    <div class="row">
                        
                        <!-- <div class="col-6 col-md-3">
                            <button type="button" class="control" data-filter="all">All</button>
                        </div> -->
                        
                        <?php $b=0; ?>
                        @foreach($faq_category as $faq_cat)
                        <div class="col-6 col-md-3">
                            <button type="button" class="control {{ $b }}" data-filter=".{{ $faq_cat->slug }}">{{ $faq_cat->name }}</button>
                        </div>
                        <?php $b++; ?>
                        @endforeach
                    </div>
                </div>

                <div class="box-store">
                    <?php $a=0; ?>
                    @foreach($faq_category as $faq_cat)
                        @foreach($faq_cat->faq as $faq)
                        <div class="mix {{ $faq_cat->slug }}" @if($a != 0) style="display: none;" @endif>
                            <div class="box-accordion">
                                <div class="pad-accordion">
                                    <div class="pos-rel">
                                        <div class="title-accordion">{!! $faq->question !!}</div>
                                        <div class="abs img-plus"><img src="{{ asset('images/plus.png') }}" alt="" title=""/></div>
                                        <div class="abs img-close"><img src="{{ asset('images/close.png') }}" alt="" title=""/></div>
                                    </div>
                                    <div class="bdy-accordion">
                                        {!! $faq->answer !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <?php $a++; ?>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/mixitup.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function() {
        $('.nav-faq').addClass('active');

		var containerEl = document.querySelector('.box-store');

        var mixer = mixitup(containerEl);

        $('.box-store .pad-accordion').click(function(event) {
            $(this).toggleClass('active');
        });

        $('.control').click(function(event) {
            $('.pad-accordion').removeClass('active');
        });

        $('.0').toggleClass('mixitup-control-active');
	});
</script>
@endsection