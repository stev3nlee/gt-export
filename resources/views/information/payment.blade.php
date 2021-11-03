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
                    <div class="col-6 col-lg-3">
                        <div class="box-payment-top">
                            <div><img src="{{ asset('images/paypal.png') }}" alt="" title=""/></div>
                            <div class="payment-mode">PayPal</div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="box-payment-top">
                            <div><img src="{{ asset('images/tt.png') }}" alt="" title=""/></div>
                            <div class="payment-mode">Telegraphic Transfer</div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="box-payment-top">
                            <div><img src="{{ asset('images/visa.png') }}" alt="" title=""/></div>
                            <div class="payment-mode">Credit Card</div>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3">
                        <div class="box-payment-top">
                            <div><img src="{{ asset('images/loc.png') }}" alt="" title=""/></div>
                            <div class="payment-mode">Letter of Credit</div>
                        </div>
                    </div>
                </div>
                <div class="box-payment">
                    <div class="box-payment-title"> PayPal </div>
                    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Hendrerit quis leo volutpat mauris sed feugiat. Maecenas vitae consectetur aliquam eleifend blandit lectus. Scelerisque semper malesuada sit scelerisque facilisi quam. Nulla pharetra sodales congue posuere fermentum, lectus posuere in. </p>
                    <p> Odio est tellus in turpis ligula rhoncus. Quam vitae suspendisse orci viverra eleifend semper. Viverra morbi sed enim eget aliquet. Eu sed lobortis lorem vulputate felis arcu felis fermentum. Eget massa praesent sed lorem gravida mattis auctor pretium nulla. Amet fermentum nunc duis tellus. Arcu massa diam donec sed auctor vestibulum, viverra. Mi consectetur pharetra netus viverra nascetur. Feugiat eget nibh etiam sit. Quam adipiscing aliquet suspendisse ultricies in ac sed egestas dictumst. </p>
                </div> 
                <div class="box-payment">
                    <div class="box-payment-title"> Telegraphic Transfer </div>
                    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Hendrerit quis leo volutpat mauris sed feugiat. Maecenas vitae consectetur aliquam eleifend blandit lectus. Scelerisque semper malesuada sit scelerisque facilisi quam. Nulla pharetra sodales congue posuere fermentum, lectus posuere in. </p>
                    <p> Odio est tellus in turpis ligula rhoncus. Quam vitae suspendisse orci viverra eleifend semper. Viverra morbi sed enim eget aliquet. Eu sed lobortis lorem vulputate felis arcu felis fermentum. Eget massa praesent sed lorem gravida mattis auctor pretium nulla. Amet fermentum nunc duis tellus. Arcu massa diam donec sed auctor vestibulum, viverra. Mi consectetur pharetra netus viverra nascetur. Feugiat eget nibh etiam sit. Quam adipiscing aliquet suspendisse ultricies in ac sed egestas dictumst. </p>
                </div> 
                <div class="box-payment">
                    <div class="box-payment-title"> Credit Card </div>
                    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Hendrerit quis leo volutpat mauris sed feugiat. Maecenas vitae consectetur aliquam eleifend blandit lectus. Scelerisque semper malesuada sit scelerisque facilisi quam. Nulla pharetra sodales congue posuere fermentum, lectus posuere in. </p>
                    <p> Odio est tellus in turpis ligula rhoncus. Quam vitae suspendisse orci viverra eleifend semper. Viverra morbi sed enim eget aliquet. Eu sed lobortis lorem vulputate felis arcu felis fermentum. Eget massa praesent sed lorem gravida mattis auctor pretium nulla. Amet fermentum nunc duis tellus. Arcu massa diam donec sed auctor vestibulum, viverra. Mi consectetur pharetra netus viverra nascetur. Feugiat eget nibh etiam sit. Quam adipiscing aliquet suspendisse ultricies in ac sed egestas dictumst. </p>
                </div> 
                <div class="box-payment">
                    <div class="box-payment-title"> Letter of Credit </div>
                    <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Hendrerit quis leo volutpat mauris sed feugiat. Maecenas vitae consectetur aliquam eleifend blandit lectus. Scelerisque semper malesuada sit scelerisque facilisi quam. Nulla pharetra sodales congue posuere fermentum, lectus posuere in. </p>
                    <p> Odio est tellus in turpis ligula rhoncus. Quam vitae suspendisse orci viverra eleifend semper. Viverra morbi sed enim eget aliquet. Eu sed lobortis lorem vulputate felis arcu felis fermentum. Eget massa praesent sed lorem gravida mattis auctor pretium nulla. Amet fermentum nunc duis tellus. Arcu massa diam donec sed auctor vestibulum, viverra. Mi consectetur pharetra netus viverra nascetur. Feugiat eget nibh etiam sit. Quam adipiscing aliquet suspendisse ultricies in ac sed egestas dictumst. </p>
                </div>      
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