@extends('layout')

@section('content')
    <div class="pad-content">
        <div class="css-payment">
            <div class="container">
                <div class="title">Payment</div>
                <div class="bdy">
                    <p>Please choose one of the following payment methods</p>
                </div>
                <div class="row">
                    @foreach($payments as $payment)
                    <div class="col-6 col-lg-3">
                        <div class="box-payment-top">
                            <div><img src="{{ asset('upload/payment/'.$payment->image) }}" alt="" title=""/></div>
                            <div class="payment-mode">{{ $payment->title }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @foreach($payments as $payment)
                <div class="box-payment">
                    <div class="box-payment-title"> {{ $payment->title }} </div>
                    {!! $payment->description !!}
                </div> 
                @endforeach     
            </div>
        </div>
    </div>

@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function() {
		$('.nav-payment').addClass('active');
	});
</script>
@endsection