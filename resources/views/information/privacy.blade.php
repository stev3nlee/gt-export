@extends('layout')

@section('content')
    <div class="pad-content">
        <div class="css-about">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="title mb20">Privacy</div>
                        <div class="bdy">
                            {!! $privacy->privacy_policy !!}
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
		
	});
</script>
@endsection