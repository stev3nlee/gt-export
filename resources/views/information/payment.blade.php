@extends('layout')

@section('content')
    <div class="pad-content">
        <div class="css-payment">
            <div class="container">
                <div class="title">Payment</div>
                <div class="bdy">
                    <p>Please choose one of the following payment methods</p>
                </div>
                <ul class="l-payment">
                	@foreach($payments as $payment)
                    <li>
                        <a data-payment="{{ $payment->slug }}">{{ $payment->title }}</a>
                    </li>
                    @endforeach
                </ul>
                @foreach($payments as $payment)
                <section class="box-content-payment" id="{{ $payment->slug }}" data-anchor="{{ $payment->slug }}">
                    <div class="t1">{{ $payment->title }}</div>
                    <div class="row">
                        <div class="col-md-4 col-lg-3 my-auto">
                            <div class="img"><img src="{{ asset('upload/payment/'.$payment->image) }}" alt="" title=""/></div>
                        </div>
                        <div class="col-md-8 col-lg-9 my-auto">
                            <div class="desc">
                                {!! $payment->description !!}
                            </div>
                        </div>
                    </div>
                </section>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function() {
		$('.nav-payment').addClass('active');

		$( "ul.l-payment li:first-child a").addClass('active');

		$('ul.l-payment li a').click(function(event) {
            $('ul.l-payment li a').removeClass('active');
            $(this).addClass('active');
            var scrollAnchor = $(this).attr('data-payment'),
            scrollPoint = $('section[data-anchor="' + scrollAnchor + '"]').offset().top - 10;
            $('body,html').animate({ scrollTop: scrollPoint }, 500);
            return false;
        });
	});
</script>
@endsection