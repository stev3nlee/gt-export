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
                            <div class="title mb10">Quotation History</div>
                            <div class="row">
                                <div class="col-md-10 my-auto">
                                    <div class="t2">View and download all quotations obtained after {{ date('d-m-Y', strtotime($member->created_at)) }} (account creation date)</div>
                                </div>
                                @if(count($next_quotations) > 0)
                                <div class="col-md-2 my-auto text-right resp-text-right">
                                    <div class="link">
                                        <a class="click-view">View All</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="bdr"></div>
                            <div class="table-order-account">
                            @if(count($quotations)>0)
                                @foreach($quotations as $quotation)
                                <div>
                                    <div class="tbl tbl-bdy">
                                        <div class="cell w130">{{ date('d/m/Y', strtotime($quotation->created_at)) }}</div>
                                        <div class="cell"><span class="bold">Quotation {{ $quotation->invoice_number }}.pdf</span></div>
                                        <!-- <div class="cell w110">100MB</div> -->
                                        <div class="cell w90">
                                            <ul class="link">
                                                <li><a target="_blank" href="{{ url('view-quotation/'.$quotation->invoice_number) }}"><img src="{{ asset('images/view.png') }}" alt="" title=""/></a></li>
                                                <li><a href="{{ url('download-quotation/'.$quotation->invoice_number) }}"><img src="{{ asset('images/download.png') }}" alt="" title=""/></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @if(count($next_quotations) > 0)
                                <div class="box-hide">
                                    @foreach($next_quotations as $next_quotation)
                                    <div>
                                        <div class="tbl tbl-bdy">
                                            <div class="cell w130">{{ date('d/m/Y', strtotime($next_quotation->created_at)) }}</div>
                                            <div class="cell"><span class="bold">Quotation {{ $next_quotation->invoice_number }}.pdf</span></div>
                                            <!-- <div class="cell w110">100MB</div> -->
                                            <div class="cell w90">
                                                <ul class="link">
                                                    <li><a href="{{ url('view-quotation/'.$next_quotation->invoice_number) }}"><img src="{{ asset('images/view.png') }}" alt="" title=""/></a></li>
                                                    <li><a href="{{ url('download-quotation/'.$next_quotation->invoice_number) }}"><img src="{{ asset('images/download.png') }}" alt="" title=""/></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            @else
                                <div class="mt20"> Currently you have not any transaction yet. </div>
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
		$('.nav-quota').addClass('active');

        $('.click-view').click(function(event) {
            $(this).hide();
            $('.box-hide').show();
        });

        $('header').addClass('account');
	});
</script>
@endsection