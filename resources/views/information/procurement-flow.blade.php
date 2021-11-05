@extends('layout')

@section('content')
    <div class="pad-content">
        <div class="css-procurement">
            <div class="container">
                <div class="title">Procurement Flow</div>
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8">
                        <div class="t1">{{ $procurement_flow_title->title }}</div>
                        <div class="bdy">
                            {!! $procurement_flow_title->description !!}
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-10 col-xl-9">
                        <div class="pos-rel">
                            <div class="bdr-tab"></div>
                            <ul class="nav nav-tabs" role="tablist">
                                <?php $i=1; ?>
                                @foreach($procurement_flows as $procurement_flow)
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link @if($i==1) active @endif" id="step{{ $i }}-tab" data-toggle="tab" href="#step{{ $i }}" role="tab" aria-controls="step{{ $i }}" aria-selected="true">
                                        <div class="bdr"></div>
                                        <div class="num">0{{ $i }}</div>
                                        <div class="img">
                                            <img src="{{ asset('/upload/procurement_flow/'.$procurement_flow->image) }}" alt="" title="" class="img-noactive"/>
                                            <img src="{{ asset('/upload/procurement_flow/'.$procurement_flow->image_active) }}" alt="" title="" class="img-active"/>
                                        </div>
                                        <div class="nm">{{ $procurement_flow->title }}</div>
                                    </a>
                                </li>
                                <?php $i++; ?>
                                @endforeach
                            </ul>
                        </div>
                        <div class="tab-content div-step">
                            <?php $j=1; ?>
                            @foreach($procurement_flows as $procurement_flow)
                            <div class="tab-pane fade @if($j==1) show active @endif" id="step{{ $j }}" role="tabpanel" aria-labelledby="step{{ $j }}-tab">
                                <div class="t">Step {{ $j }}</div>
                                <div class="t2">{{ $procurement_flow->title }}</div>
                                <div class="desc">
                                    {!! $procurement_flow->description !!}
                                </div>
                                <div class="row">
                                    @if($j == 1)
                                    <div class="col-12 text-right">
                                        <div class="link-step">
                                            <a class="click-payment">
                                                <div class="text1">Next <i class="fas fa-chevron-right"></i></div>
                                                <div class="text2">{{ $procurement_flows[1]->title }}</div>
                                            </a>
                                        </div>
                                    </div>
                                    @elseif($j == 2)
                                    <div class="col-6">
                                        <div class="link-step left">
                                            <a class="click-vehicle">
                                                <div class="text1">Previous <i class="fas fa-chevron-left"></i></div>
                                                <div class="text2">{{ $procurement_flows[0]->title }}</div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-6 text-right">
                                        <div class="link-step">
                                            <a class="click-delivery">
                                                <div class="text1">Next <i class="fas fa-chevron-right"></i></div>
                                                <div class="text2">{{ $procurement_flows[2]->title }}</div>
                                            </a>
                                        </div>
                                    </div>
                                    @elseif($j == 3)
                                    <div class="col-6">
                                        <div class="link-step left">
                                            <a class="click-payment">
                                                <div class="text1">Previous <i class="fas fa-chevron-left"></i></div>
                                                <div class="text2">{{ $procurement_flows[1]->title }}</div>
                                            </a>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <?php $j++; ?>
                            @endforeach
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
        $('.nav-procurement').addClass('active');

        $('.click-vehicle').on('click', function (event) {
            event.preventDefault();
            $('#step1').tab('show');
            $('#step2,#step3').removeClass('show');
            $('#step2,#step3').removeClass('active');
            $('.nav-link').removeClass('active');
            $('#step1-tab').addClass('active');
            $("body, html").animate({
                scrollTop: $(".div-step").position().top
            });
        });
        $('.click-payment').on('click', function (event) {
            event.preventDefault();
            $('#step2').tab('show');
            $('#step1,#step3').removeClass('show');
            $('#step1,#step3').removeClass('active');
            $('.nav-link').removeClass('active');
            $('#step2-tab').addClass('active');
            $("body, html").animate({
                scrollTop: $(".div-step").position().top
            });
        });
        $('.click-delivery').on('click', function (event) {
            event.preventDefault();
            $('#step3').tab('show');
            $('#step1,#step2').removeClass('show');
            $('#step1,#step2').removeClass('active');
            $('.nav-link').removeClass('active');
            $('#step3-tab').addClass('active');
            $("body, html").animate({
                scrollTop: $(".div-step").position().top
            });
        });
	});
</script>
@endsection