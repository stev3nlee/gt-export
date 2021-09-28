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
                            <div class="title mb10">Shipment Documentation</div>
                            <div class="row">
                                <div class="col-md-10 my-auto">
                                    <div class="t2">View and download all shipping related documents. Documents can only be retrieved after payment confirmation.</div>
                                </div>
                                @if(count($next_shipments) > 0)
                                <div class="col-md-2 my-auto text-right resp-text-right">
                                    <div class="link">
                                        <a class="click-view">View All</a>
                                    </div>
                                </div>
                                @endif
                            </div>
                            <div class="bdr"></div>
                            <div class="table-order-account">
                            @if(count($shipments)>0)
                                @foreach($shipments as $shipment)
                                <div>
                                    <div class="tbl tbl-bdy">
                                        <div class="cell w130">{{ date('d/m/Y', strtotime($shipment->created_at)) }}</div>
                                        <div class="cell"><span class="bold">{{ $shipment->file }}</span></div>
                                        <div class="cell w110">{{ $shipment->size }}KB</div>
                                        <div class="cell w90">
                                            <ul class="link">
                                                <li><a target="_blank" href="{{ url('view-shipment-document/'.$shipment->id) }}"><img src="{{ asset('images/view.png') }}" alt="" title=""/></a></li>
                                                <li><a href="{{ url('download-shipment-document/'.$shipment->id) }}"><img src="{{ asset('images/download.png') }}" alt="" title=""/></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @if(count($next_shipments) > 0)
                                <div class="box-hide">
                                    @foreach($next_shipments as $next_shipment)
                                    <div>
                                        <div class="tbl tbl-bdy">
                                            <div class="cell w130">{{ date('d/m/Y', strtotime($next_shipment->created_at)) }}</div>
                                            <div class="cell"><span class="bold">{{ $next_shipment->file }}</span></div>
                                            <div class="cell w110">{{ $next_shipment->size }}KB</div>
                                            <div class="cell w90">
                                                <ul class="link">
                                                    <li><a target="_blank" href="{{ url('view-shipment-document/'.$shipment->id) }}"><img src="{{ asset('images/view.png') }}" alt="" title=""/></a></li>
                                                    <li><a href="{{ url('download-shipment-document/'.$shipment->id) }}"><img src="{{ asset('images/download.png') }}" alt="" title=""/></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                @endif
                            @else
                                <div class="mt20"> Currently you have not any shipment document yet. </div>
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
		$('.nav-ship').addClass('active');

        $('.click-view').click(function(event) {
            $(this).hide();
            $('.box-hide').show();
        });

        ('header').addClass('account');
	});
</script>
@endsection