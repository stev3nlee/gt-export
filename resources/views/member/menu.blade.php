<div class="img-profile">
	@if($member->image)
        <img src="{{ asset('upload/profile/'.$member->image) }}" alt="" title=""/>
    @else
        <img src="{{ asset('images/no-profile.png') }}" alt="" title=""/>
    @endif 
</div>
<div class="name">{{ $member->first_name }} {{ $member->last_name }}</div>
<ul class="l-account">
	<li><a href="{{ URL::to('/personal-info') }}" class="nav-info">Personal Information</a></li>
	<li><a href="{{ URL::to('/transaction-history') }}" class="nav-trans">Transaction History</a></li>
	<li><a href="{{ URL::to('/quotation-history') }}" class="nav-quota">Quotation History</a></li>
	<li><a href="{{ URL::to('/shipment-documentation') }}" class="nav-ship">Shipment Documentation</a></li>
	<li><a href="{{ URL::to('/logout') }}" class="nav">Logout</a></li>
</ul>