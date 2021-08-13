@extends('layout')

@section('content')
    <div class="pad-content">
        <div class="css-faq">
            <div class="container">
                <div class="title">Frequently Asked Questions</div>
                <div class="bdy">
                    <p>Regulation details for all our destination countries</p>
                </div>
                <div class="controls">
                    <div class="row">
                        <div class="col-6 col-md-3">
                            <button type="button" class="control" data-filter="all">All</button>
                        </div>
                        <div class="col-6 col-md-3">
                            <button type="button" class="control" data-filter=".payment-enquiry">Payment Enquiry</button>
                        </div>
                        <div class="col-6 col-md-3">
                            <button type="button" class="control" data-filter=".vehicle-ownership">Vehicle Ownership</button>
                        </div>
                        <div class="col-6 col-md-3">
                            <button type="button" class="control" data-filter=".procurement-details">Procurement Details</button>
                        </div>
                        <div class="col-6 col-md-3">
                            <button type="button" class="control" data-filter=".lorem-ipsum">Lorem Ipsum</button>
                        </div>
                        <div class="col-6 col-md-3">
                            <button type="button" class="control" data-filter=".dolor-sit-amet">Dolor sit amet</button>
                        </div>
                    </div>
                </div>

                <div class="box-store">
                    <div class="mix vehicle-ownership">
                        <div class="box-accordion">
                            <div class="pad-accordion">
                                <div class="pos-rel">
                                    <div class="title-accordion">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                    <div class="abs img-plus"><img src="{{ asset('images/plus.png') }}" alt="" title=""/></div>
                                    <div class="abs img-close"><img src="{{ asset('images/close.png') }}" alt="" title=""/></div>
                                </div>
                                <div class="bdy-accordion">
                                    <p>At varius vel pharetra vel turpis nunc. Enim ut tellus elementum sagittis vitae et. Laoreet sit amet cursus sit amet dictum sit.</p>
                                    <p>Egestas sed sed risus pretium. Ullamcorper velit sed ullamcorper morbi. Dictumst quisque sagittis purus sit amet volutpat. Id neque aliquam vestibulum morbi blandit cursus. Id nibh tortor id aliquet lectus proin nibh nisl. Faucibus scelerisque eleifend donec pretium vulputate. Potenti nullam ac tortor vitae. Dolor morbi non arcu risus quis varius quam quisque id. Accumsan in nisl nisi scelerisque eu ultrices.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mix payment-enquiry">
                        <div class="box-accordion">
                            <div class="pad-accordion">
                                <div class="pos-rel">
                                    <div class="title-accordion">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                    <div class="abs img-plus"><img src="{{ asset('images/plus.png') }}" alt="" title=""/></div>
                                    <div class="abs img-close"><img src="{{ asset('images/close.png') }}" alt="" title=""/></div>
                                </div>
                                <div class="bdy-accordion">
                                    <p>At varius vel pharetra vel turpis nunc. Enim ut tellus elementum sagittis vitae et. Laoreet sit amet cursus sit amet dictum sit.</p>
                                    <p>Egestas sed sed risus pretium. Ullamcorper velit sed ullamcorper morbi. Dictumst quisque sagittis purus sit amet volutpat. Id neque aliquam vestibulum morbi blandit cursus. Id nibh tortor id aliquet lectus proin nibh nisl. Faucibus scelerisque eleifend donec pretium vulputate. Potenti nullam ac tortor vitae. Dolor morbi non arcu risus quis varius quam quisque id. Accumsan in nisl nisi scelerisque eu ultrices.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mix payment-enquiry">
                        <div class="box-accordion">
                            <div class="pad-accordion">
                                <div class="pos-rel">
                                    <div class="title-accordion">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                    <div class="abs img-plus"><img src="{{ asset('images/plus.png') }}" alt="" title=""/></div>
                                    <div class="abs img-close"><img src="{{ asset('images/close.png') }}" alt="" title=""/></div>
                                </div>
                                <div class="bdy-accordion">
                                    <p>At varius vel pharetra vel turpis nunc. Enim ut tellus elementum sagittis vitae et. Laoreet sit amet cursus sit amet dictum sit.</p>
                                    <p>Egestas sed sed risus pretium. Ullamcorper velit sed ullamcorper morbi. Dictumst quisque sagittis purus sit amet volutpat. Id neque aliquam vestibulum morbi blandit cursus. Id nibh tortor id aliquet lectus proin nibh nisl. Faucibus scelerisque eleifend donec pretium vulputate. Potenti nullam ac tortor vitae. Dolor morbi non arcu risus quis varius quam quisque id. Accumsan in nisl nisi scelerisque eu ultrices.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mix vehicle-ownership">
                        <div class="box-accordion">
                            <div class="pad-accordion">
                                <div class="pos-rel">
                                    <div class="title-accordion">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                    <div class="abs img-plus"><img src="{{ asset('images/plus.png') }}" alt="" title=""/></div>
                                    <div class="abs img-close"><img src="{{ asset('images/close.png') }}" alt="" title=""/></div>
                                </div>
                                <div class="bdy-accordion">
                                    <p>At varius vel pharetra vel turpis nunc. Enim ut tellus elementum sagittis vitae et. Laoreet sit amet cursus sit amet dictum sit.</p>
                                    <p>Egestas sed sed risus pretium. Ullamcorper velit sed ullamcorper morbi. Dictumst quisque sagittis purus sit amet volutpat. Id neque aliquam vestibulum morbi blandit cursus. Id nibh tortor id aliquet lectus proin nibh nisl. Faucibus scelerisque eleifend donec pretium vulputate. Potenti nullam ac tortor vitae. Dolor morbi non arcu risus quis varius quam quisque id. Accumsan in nisl nisi scelerisque eu ultrices.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mix procurement-details">
                        <div class="box-accordion">
                            <div class="pad-accordion">
                                <div class="pos-rel">
                                    <div class="title-accordion">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                    <div class="abs img-plus"><img src="{{ asset('images/plus.png') }}" alt="" title=""/></div>
                                    <div class="abs img-close"><img src="{{ asset('images/close.png') }}" alt="" title=""/></div>
                                </div>
                                <div class="bdy-accordion">
                                    <p>At varius vel pharetra vel turpis nunc. Enim ut tellus elementum sagittis vitae et. Laoreet sit amet cursus sit amet dictum sit.</p>
                                    <p>Egestas sed sed risus pretium. Ullamcorper velit sed ullamcorper morbi. Dictumst quisque sagittis purus sit amet volutpat. Id neque aliquam vestibulum morbi blandit cursus. Id nibh tortor id aliquet lectus proin nibh nisl. Faucibus scelerisque eleifend donec pretium vulputate. Potenti nullam ac tortor vitae. Dolor morbi non arcu risus quis varius quam quisque id. Accumsan in nisl nisi scelerisque eu ultrices.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mix lorem-ipsum">
                        <div class="box-accordion">
                            <div class="pad-accordion">
                                <div class="pos-rel">
                                    <div class="title-accordion">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                    <div class="abs img-plus"><img src="{{ asset('images/plus.png') }}" alt="" title=""/></div>
                                    <div class="abs img-close"><img src="{{ asset('images/close.png') }}" alt="" title=""/></div>
                                </div>
                                <div class="bdy-accordion">
                                    <p>At varius vel pharetra vel turpis nunc. Enim ut tellus elementum sagittis vitae et. Laoreet sit amet cursus sit amet dictum sit.</p>
                                    <p>Egestas sed sed risus pretium. Ullamcorper velit sed ullamcorper morbi. Dictumst quisque sagittis purus sit amet volutpat. Id neque aliquam vestibulum morbi blandit cursus. Id nibh tortor id aliquet lectus proin nibh nisl. Faucibus scelerisque eleifend donec pretium vulputate. Potenti nullam ac tortor vitae. Dolor morbi non arcu risus quis varius quam quisque id. Accumsan in nisl nisi scelerisque eu ultrices.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mix lorem-ipsum">
                        <div class="box-accordion">
                            <div class="pad-accordion">
                                <div class="pos-rel">
                                    <div class="title-accordion">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                    <div class="abs img-plus"><img src="{{ asset('images/plus.png') }}" alt="" title=""/></div>
                                    <div class="abs img-close"><img src="{{ asset('images/close.png') }}" alt="" title=""/></div>
                                </div>
                                <div class="bdy-accordion">
                                    <p>At varius vel pharetra vel turpis nunc. Enim ut tellus elementum sagittis vitae et. Laoreet sit amet cursus sit amet dictum sit.</p>
                                    <p>Egestas sed sed risus pretium. Ullamcorper velit sed ullamcorper morbi. Dictumst quisque sagittis purus sit amet volutpat. Id neque aliquam vestibulum morbi blandit cursus. Id nibh tortor id aliquet lectus proin nibh nisl. Faucibus scelerisque eleifend donec pretium vulputate. Potenti nullam ac tortor vitae. Dolor morbi non arcu risus quis varius quam quisque id. Accumsan in nisl nisi scelerisque eu ultrices.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mix vehicle-ownership">
                        <div class="box-accordion">
                            <div class="pad-accordion">
                                <div class="pos-rel">
                                    <div class="title-accordion">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                    <div class="abs img-plus"><img src="{{ asset('images/plus.png') }}" alt="" title=""/></div>
                                    <div class="abs img-close"><img src="{{ asset('images/close.png') }}" alt="" title=""/></div>
                                </div>
                                <div class="bdy-accordion">
                                    <p>At varius vel pharetra vel turpis nunc. Enim ut tellus elementum sagittis vitae et. Laoreet sit amet cursus sit amet dictum sit.</p>
                                    <p>Egestas sed sed risus pretium. Ullamcorper velit sed ullamcorper morbi. Dictumst quisque sagittis purus sit amet volutpat. Id neque aliquam vestibulum morbi blandit cursus. Id nibh tortor id aliquet lectus proin nibh nisl. Faucibus scelerisque eleifend donec pretium vulputate. Potenti nullam ac tortor vitae. Dolor morbi non arcu risus quis varius quam quisque id. Accumsan in nisl nisi scelerisque eu ultrices.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mix dolor-sit-amet">
                        <div class="box-accordion">
                            <div class="pad-accordion">
                                <div class="pos-rel">
                                    <div class="title-accordion">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                                    <div class="abs img-plus"><img src="{{ asset('images/plus.png') }}" alt="" title=""/></div>
                                    <div class="abs img-close"><img src="{{ asset('images/close.png') }}" alt="" title=""/></div>
                                </div>
                                <div class="bdy-accordion">
                                    <p>At varius vel pharetra vel turpis nunc. Enim ut tellus elementum sagittis vitae et. Laoreet sit amet cursus sit amet dictum sit.</p>
                                    <p>Egestas sed sed risus pretium. Ullamcorper velit sed ullamcorper morbi. Dictumst quisque sagittis purus sit amet volutpat. Id neque aliquam vestibulum morbi blandit cursus. Id nibh tortor id aliquet lectus proin nibh nisl. Faucibus scelerisque eleifend donec pretium vulputate. Potenti nullam ac tortor vitae. Dolor morbi non arcu risus quis varius quam quisque id. Accumsan in nisl nisi scelerisque eu ultrices.</p>
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
<script type="text/javascript" src="{{ asset('js/mixitup.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function() {
        $('.nav-faq').addClass('active');

		var containerEl = document.querySelector('.box-store');

        var mixer = mixitup(containerEl);

        $('.box-store .pad-accordion').click(function(event) {
            $(this).toggleClass('active');
        });

        $('.control').click(function(event) {
            $('.pad-accordion').removeClass('active');
        });
	});
</script>
@endsection