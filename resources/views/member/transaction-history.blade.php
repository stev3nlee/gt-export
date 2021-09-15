@extends('layout')

@section('content')
    <div class="pad-content pt30">
        <div class="css-account">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="left-account">
                            @include('member.menu')
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="right-account">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="title mb40">Transaction History</div>
                                </div>
                                @if(count($next_orders) > 0)
                                <div class="col-md-6 text-right resp-text-right">
                                    <div class="link">
                                        <a class="click-view">View All</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="table-order-account table-trans">
                            @if(count($orders)>0)
                                <div>
                                    <div class="tbl tbl-hdr">
                                        <div class="cell text-center w130">Date</div>
                                        <div class="cell text-center w150">Transaction Number</div>
                                        <div class="cell text-center">Description</div>
                                        <div class="cell text-center w100">Amount</div>
                                        <div class="cell text-center w100 pr0">Status</div>
                                    </div>
                                </div>
                                @foreach($orders as $order)
                                <div class="xs30">
                                    <div class="tbl tbl-bdy">
                                        <div class="cell text-center w130"><span class="show-title">Date:</span>{{ date('d-m-Y', strtotime($order->created_at)) }}</div>
                                        <div class="cell text-center w150"><span class="show-title">Transaction Number:</span># {{ $order->quotation_number }}</div>
                                        <div class="cell text-center"><span class="show-title">Description:</span>BMW 3 Series, Automatic</div>
                                        <div class="cell text-center w100"><span class="show-title">Amount:</span>S$ {{ number_format($order->price, 2, '.', ',') }}</div>
                                        <div class="cell text-center w100 pr0"><span class="show-title">Status:</span>
                                        @if($order->status == 1)
                                        <span class="blue">Pending</span>
                                        @elseif($order->status == 2)
                                        <span class="green">Fulfilled</span>
                                        @else
                                        <span class="red">Unsuccessful</span>
                                        @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @if(count($next_orders) > 0)
                                <div class="box-hide">
                                    @foreach($next_orders as $next_order)
                                    <div class="xs30">
                                        <div class="tbl tbl-bdy">
                                            <div class="cell text-center w130"><span class="show-title">Date:</span>{{ date('d-m-Y', strtotime($next_order->created_at)) }}</div>
                                            <div class="cell text-center w150"><span class="show-title">Transaction Number:</span># {{ $next_order->quotation_number }}</div>
                                            <div class="cell text-center"><span class="show-title">Description:</span>BMW 3 Series, Automatic</div>
                                            <div class="cell text-center w100"><span class="show-title">Amount:</span>S$ {{ number_format($next_order->price, 2, '.', ',') }}</div>
                                            <div class="cell text-center w100 pr0"><span class="show-title">Status:</span>
                                            @if($next_order->status == 1)
                                            <span class="blue">Pending</span>
                                            @elseif($next_order->status == 2)
                                            <span class="green">Fulfilled</span>
                                            @else
                                            <span class="red">Unsuccessful</span>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            @else
                                Currently you have not any transaction yet.
                            @endif
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
		$('.nav-trans').addClass('active');

        $('.click-view').click(function(event) {
            $(this).hide();
            $('.box-hide').show();
        });

        $('header').addClass('account');
	});
</script>
@endsection