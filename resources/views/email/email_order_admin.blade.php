<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ORDER CONFIRMATION</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #000000;line-height: 24px;">
<?php if(isset($url)){ $url = $url; }else{ $url = url('/'); } ?>
	<div style="width:600px;margin:0 auto;background-color:transparent; text-align:center;">
		<div style="text-align: center;padding: 10px 0;">
			<a href="https://prepbox.sg">
				<img src="{{ $url }}/images/email/header.png" />
			</a>
		</div>
		<div style="font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
			<p>Hi Admin,</p>
		</div>
		<div style="font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
			<p>Please proceed this order for customer satisfaction :)</p>
		</div>

		<div>
			<table style="font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word; border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 25px;">
				<thead>
					<tr>
						<td style="font-size: 13px; font-weight: bold; text-align: center; padding: 5px 10px; border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;" colspan="2">Your Order Details</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px; width:50%;">Order No:</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">{{ $order->invoice_number }}</td>
					</tr>
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px; width:50%;">Order Date:</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;"><?php echo date('d F Y H:i:s', strtotime($order->created_at)); ?></td>
					</tr>
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px; width:50%;">Plan:</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">{{ $order->plan->name }}</td>
					</tr>
				</tbody>
			</table>

			<table style="font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word; border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 25px;">
				<thead>
					<tr>
						<td style="font-size: 13px; font-weight: bold; text-align: center; padding: 5px 10px; border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;" colspan="2">Delivery Details</td>
					</tr>
				</thead>
				@if($order->order_shipping_address)
				<tbody>
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px; width:50%;">Name:</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">{{ $order->order_shipping_address->first_name }} {{ $order->order_shipping_address->last_name }}</td>
					</tr>
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px; width:50%;">Mobile:</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;"></td>
					</tr>
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px; width:50%;">Email:</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">{{ $order->member->email }}</td>
					</tr>
					@if($order->order_shipping_address->company)
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px; width:50%;">Company:</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">{{ $order->order_shipping_address->company }}</td>
					</tr>
					@endif
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px; width:50%;">Address:</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">{{ $order->order_shipping_address->address }}@if($order->order_shipping_address->notes), {{ $order->order_shipping_address->notes }}@endif, {{ $order->order_shipping_address->country }} {{ $order->order_shipping_address->postal_code }}</td>
					</tr>
				</tbody>
				@else
					<tbody>
						<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;" colspan="2">This user haven't fill in the delivery time & slot</td>
						</tr>
						
					</tbody>
				@endif
			</table>
			

			<table style="font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word; border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 25px;">
				<thead>
					<tr>
						<td style="font-size: 13px; font-weight: bold; text-align: center; padding: 5px 10px; border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;" colspan="2">Payment Details</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px; width:50%;">Payment Method:</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">{{ ucwords($order->member->card_brand) }}</td>
					</tr>
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px; width:50%;">Total Price:</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">SGD ${{ number_format($order->total_price, 2, '.', '') }}</td>
					</tr>
					@if($order->delivery_day_time_id)
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px; width:50%;">Delivery Timeslot:</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">{{ ucwords($order->day_delivery) }} {{ $order->time_delivery }}</td>
					</tr>
					@endif
				</tbody>
			</table>

			<div style="margin-bottom: 5px;font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
				<p style="font-weight:bold;">
				Receipt for Your Order
				<br />
				Order No #{{ $order->invoice_number }} </p>
			</div>

			<table style="font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word; border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD;">
				<tr>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 10px;" colspan="3">
						{{ $order->plan->diet_preference->name }} Menu  <br />
						{{ $order->plan->name }} <br />
						for week of {{ date('jS M Y', strtotime($order->order_weeks[0]->date)) }}<br/> 
					</td>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 10px 20px 10px 10px;" colspan="3"></td>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 10px;"> SGD ${{ number_format($order->sub_total, 2, '.', '') }} </td>
				</tr>
				@if(count($order->order_weeks)>0)
				@foreach($order->order_weeks as $order_week)
					@if($order_week->date > date('Y-m-d'))
					@foreach($order_week->order_details as $order_detail)
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding:5px 10px;" colspan="3"> {{ $order_detail->product_name }} </td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding:5px 10px;;" colspan="3">x 1</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding:5px 10px;">
						</td>
					</tr>
					@endforeach
					@break
					@else
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding:5px 10px;" colspan="6">Pick your meals. </td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding:5px 10px;">
						</td>
					</tr>
					@break
					@endif
				@endforeach
				@endif
				<tr>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px;" colspan="3"></td>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px;" colspan="3">Subtotal</td>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px;">$ {{  number_format($order->sub_total, 2, '.', '') }} </td>
				</tr>
				<tr>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px;" colspan="3"></td>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px;" colspan="3">Delivery</td>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px;">$ {{ number_format($order->shipping_fee, 2, '.', '') }} </td>
				</tr>
				@if($order->discount_price > 0)
				<tr>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px;" colspan="3"></td>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px;" colspan="3">Promotion</td>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px;">$ {{ number_format($order->discount_price, 2, '.', '') }} </td>
				</tr>
				@endif
				<tr>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px;" colspan="3"></td>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px;" colspan="3"><b> Total (inclusive of GST) </b></td>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px;"><b> $ {{ number_format($order->total_price, 2, '.', '') }} </b></td>
				</tr>
			</table>
		</div>
		<div style="font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
			<!-- <div style="margin-top:20px; margin-bottom: 20px;">
				<p> Next charge will be on <b>.</b> </p>
			</div> -->
			<div style="margin-bottom: 20px;">
				<p> <a href="https://prepbox.sg/login">Log in</a> to manage your subscription. </p>
			</div>
			<div style="margin-bottom: 5px;">
				<p> As usual, if you have any questions, you may visit our <a href="https://prepbox.sg/faq">FAQ page</a>, or contact us at <a href="mailto:prepbox@createries.com">prepbox@createries.com</a> </p>
			</div>
		</div>
		<div style="text-align:center; padding:5px 0;">
			<a href="https://prepbox.sg">
				<img src="{{ $url }}/images/email/footer.png" />
			</a>
		</div>
	</div>
</body>
</html>
