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
                                <div class="col-md-6 text-right resp-text-right">
                                    <div class="link">
                                        <a class="click-view">View All</a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-order-account table-trans">
                                <div>
                                    <div class="tbl tbl-hdr">
                                        <div class="cell text-center w130">Date</div>
                                        <div class="cell text-center w150">Transaction Number</div>
                                        <div class="cell text-center">Description</div>
                                        <div class="cell text-center w100">Amount</div>
                                        <div class="cell text-center w100 pr0">Status</div>
                                    </div>
                                </div>
                                <div class="xs30">
                                    <div class="tbl tbl-bdy">
                                        <div class="cell text-center w130"><span class="show-title">Date:</span>02-01-2020</div>
                                        <div class="cell text-center w150"><span class="show-title">Transaction Number:</span># 459903</div>
                                        <div class="cell text-center"><span class="show-title">Description:</span>BMW 3 Series, Automatic</div>
                                        <div class="cell text-center w100"><span class="show-title">Amount:</span>S$ 500,000</div>
                                        <div class="cell text-center w100 pr0"><span class="show-title">Status:</span><span class="blue">Pending</span></div>
                                    </div>
                                </div>
                                <div class="xs30">
                                    <div class="tbl tbl-bdy">
                                        <div class="cell text-center w130"><span class="show-title">Date:</span>02-01-2020</div>
                                        <div class="cell text-center w150"><span class="show-title">Transaction Number:</span># 459903</div>
                                        <div class="cell text-center"><span class="show-title">Description:</span>BMW 3 Series, Automatic</div>
                                        <div class="cell text-center w100"><span class="show-title">Amount:</span>S$ 500,000</div>
                                        <div class="cell text-center w100 pr0"><span class="show-title">Status:</span><span class="red">Unsuccessful</span></div>
                                    </div>
                                </div>
                                <div class="xs30">
                                    <div class="tbl tbl-bdy">
                                        <div class="cell text-center w130"><span class="show-title">Date:</span>02-01-2020</div>
                                        <div class="cell text-center w150"><span class="show-title">Transaction Number:</span># 459903</div>
                                        <div class="cell text-center"><span class="show-title">Description:</span>BMW 3 Series, Automatic</div>
                                        <div class="cell text-center w100"><span class="show-title">Amount:</span>S$ 500,000</div>
                                        <div class="cell text-center w100 pr0"><span class="show-title">Status:</span><span class="green">Fulfilled</span></div>
                                    </div>
                                </div>
                                <div class="xs30">
                                    <div class="tbl tbl-bdy">
                                        <div class="cell text-center w130"><span class="show-title">Date:</span>02-01-2020</div>
                                        <div class="cell text-center w150"><span class="show-title">Transaction Number:</span># 459903</div>
                                        <div class="cell text-center"><span class="show-title">Description:</span>BMW 3 Series, Automatic</div>
                                        <div class="cell text-center w100"><span class="show-title">Amount:</span>S$ 500,000</div>
                                        <div class="cell text-center w100 pr0"><span class="show-title">Status:</span><span class="blue">Pending</span></div>
                                    </div>
                                </div>
                                <div class="xs30">
                                    <div class="tbl tbl-bdy">
                                        <div class="cell text-center w130"><span class="show-title">Date:</span>02-01-2020</div>
                                        <div class="cell text-center w150"><span class="show-title">Transaction Number:</span># 459903</div>
                                        <div class="cell text-center"><span class="show-title">Description:</span>BMW 3 Series, Automatic</div>
                                        <div class="cell text-center w100"><span class="show-title">Amount:</span>S$ 500,000</div>
                                        <div class="cell text-center w100 pr0"><span class="show-title">Status:</span><span class="red">Unsuccessful</span></div>
                                    </div>
                                </div>
                                <div class="xs30">
                                    <div class="tbl tbl-bdy">
                                        <div class="cell text-center w130"><span class="show-title">Date:</span>02-01-2020</div>
                                        <div class="cell text-center w150"><span class="show-title">Transaction Number:</span># 459903</div>
                                        <div class="cell text-center"><span class="show-title">Description:</span>BMW 3 Series, Automatic</div>
                                        <div class="cell text-center w100"><span class="show-title">Amount:</span>S$ 500,000</div>
                                        <div class="cell text-center w100 pr0"><span class="show-title">Status:</span><span class="green">Fulfilled</span></div>
                                    </div>
                                </div>
                                <div class="xs30">
                                    <div class="tbl tbl-bdy">
                                        <div class="cell text-center w130"><span class="show-title">Date:</span>02-01-2020</div>
                                        <div class="cell text-center w150"><span class="show-title">Transaction Number:</span># 459903</div>
                                        <div class="cell text-center"><span class="show-title">Description:</span>BMW 3 Series, Automatic</div>
                                        <div class="cell text-center w100"><span class="show-title">Amount:</span>S$ 500,000</div>
                                        <div class="cell text-center w100 pr0"><span class="show-title">Status:</span><span class="blue">Pending</span></div>
                                    </div>
                                </div>
                                <div class="xs30">
                                    <div class="tbl tbl-bdy">
                                        <div class="cell text-center w130"><span class="show-title">Date:</span>02-01-2020</div>
                                        <div class="cell text-center w150"><span class="show-title">Transaction Number:</span># 459903</div>
                                        <div class="cell text-center"><span class="show-title">Description:</span>BMW 3 Series, Automatic</div>
                                        <div class="cell text-center w100"><span class="show-title">Amount:</span>S$ 500,000</div>
                                        <div class="cell text-center w100 pr0"><span class="show-title">Status:</span><span class="red">Unsuccessful</span></div>
                                    </div>
                                </div>
                                <div class="xs30">
                                    <div class="tbl tbl-bdy">
                                        <div class="cell text-center w130"><span class="show-title">Date:</span>02-01-2020</div>
                                        <div class="cell text-center w150"><span class="show-title">Transaction Number:</span># 459903</div>
                                        <div class="cell text-center"><span class="show-title">Description:</span>BMW 3 Series, Automatic</div>
                                        <div class="cell text-center w100"><span class="show-title">Amount:</span>S$ 500,000</div>
                                        <div class="cell text-center w100 pr0"><span class="show-title">Status:</span><span class="green">Fulfilled</span></div>
                                    </div>
                                </div>
                                <div class="box-hide">
                                    <div class="xs30">
                                        <div class="tbl tbl-bdy">
                                            <div class="cell text-center w130"><span class="show-title">Date:</span>02-01-2020</div>
                                            <div class="cell text-center w150"><span class="show-title">Transaction Number:</span># 459903</div>
                                            <div class="cell text-center"><span class="show-title">Description:</span>BMW 3 Series, Automatic</div>
                                            <div class="cell text-center w100"><span class="show-title">Amount:</span>S$ 500,000</div>
                                            <div class="cell text-center w100 pr0"><span class="show-title">Status:</span><span class="red">Unsuccessful</span></div>
                                        </div>
                                    </div>
                                    <div class="xs30">
                                        <div class="tbl tbl-bdy">
                                            <div class="cell text-center w130"><span class="show-title">Date:</span>02-01-2020</div>
                                            <div class="cell text-center w150"><span class="show-title">Transaction Number:</span># 459903</div>
                                            <div class="cell text-center"><span class="show-title">Description:</span>BMW 3 Series, Automatic</div>
                                            <div class="cell text-center w100"><span class="show-title">Amount:</span>S$ 500,000</div>
                                            <div class="cell text-center w100 pr0"><span class="show-title">Status:</span><span class="green">Fulfilled</span></div>
                                        </div>
                                    </div>
                                    <div class="xs30">
                                        <div class="tbl tbl-bdy">
                                            <div class="cell text-center w130"><span class="show-title">Date:</span>02-01-2020</div>
                                            <div class="cell text-center w150"><span class="show-title">Transaction Number:</span># 459903</div>
                                            <div class="cell text-center"><span class="show-title">Description:</span>BMW 3 Series, Automatic</div>
                                            <div class="cell text-center w100"><span class="show-title">Amount:</span>S$ 500,000</div>
                                            <div class="cell text-center w100 pr0"><span class="show-title">Status:</span><span class="blue">Pending</span></div>
                                        </div>
                                    </div>
                                    <div class="xs30">
                                        <div class="tbl tbl-bdy">
                                            <div class="cell text-center w130"><span class="show-title">Date:</span>02-01-2020</div>
                                            <div class="cell text-center w150"><span class="show-title">Transaction Number:</span># 459903</div>
                                            <div class="cell text-center"><span class="show-title">Description:</span>BMW 3 Series, Automatic</div>
                                            <div class="cell text-center w100"><span class="show-title">Amount:</span>S$ 500,000</div>
                                            <div class="cell text-center w100 pr0"><span class="show-title">Status:</span><span class="red">Unsuccessful</span></div>
                                        </div>
                                    </div>
                                    <div class="xs30">
                                        <div class="tbl tbl-bdy">
                                            <div class="cell text-center w130"><span class="show-title">Date:</span>02-01-2020</div>
                                            <div class="cell text-center w150"><span class="show-title">Transaction Number:</span># 459903</div>
                                            <div class="cell text-center"><span class="show-title">Description:</span>BMW 3 Series, Automatic</div>
                                            <div class="cell text-center w100"><span class="show-title">Amount:</span>S$ 500,000</div>
                                            <div class="cell text-center w100 pr0"><span class="show-title">Status:</span><span class="green">Fulfilled</span></div>
                                        </div>
                                    </div>
                                </div>
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