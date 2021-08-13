<div class="img-profile">
	<img src="{{ asset('images/profile.jpg') }}" alt="" title=""/>
</div>
<div class="name">Dennis Tan</div>
<ul class="l-account">
	<li><a href="{{ URL::to('/personal-info') }}" class="nav-info">Personal Information</a></li>
	<li><a href="{{ URL::to('/transaction-history') }}" class="nav-trans">Transaction History</a></li>
	<li><a href="{{ URL::to('/quotation-history') }}" class="nav-quota">Quotation History</a></li>
	<li><a href="{{ URL::to('/shipment-documentation') }}" class="nav-ship">Shipment Documentation</a></li>
</ul>