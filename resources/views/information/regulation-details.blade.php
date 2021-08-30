@extends('layout')

@section('content')
    <div class="pad-content">
        <div class="css-regulation">
            <div class="container">
                <div class="title">Regulation Details</div>
                <div class="bdy">
                    <p>Regulation details for all our destination countries</p>
                </div>
                @foreach($regulations as $regulation)
                <div class="item">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="pos-rel">
                                <div class="img">
                                    <img src="{{ asset('upload/regulation/'.$regulation->image) }}" alt="{{ $regulation->title }}" title="{{ $regulation->title }}"/>
                                </div>
                                <div class="text">{{ $regulation->title }}</div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="desc">
                                {!! $regulation->description !!}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function() {
		$('.nav-regulation').addClass('active');
	});
</script>
@endsection