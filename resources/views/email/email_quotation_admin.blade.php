<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Quotation</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #000000;line-height: 24px;">
<?php if(isset($url)){ $url = $url; }else{ $url = url('/'); } ?>
	<div style="width:600px;margin:0 auto;background-color:transparent; text-align:center;">
		<div style="text-align: center;padding: 10px 0;">
			<a href="{{ $url }}">
				<img src="{{ $url }}/images/logo.png" />
			</a>
		</div>
		<div style="font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
			<p>Dear Admin</p>
		</div>
		<div style="font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
			<?php if($status == 'confirmation'){ ?>
				<p>We have received your quotation and will be processing it as soon as possible. Your quotation details are below:</p>
			<?php }else if($status == 'payment_received'){ ?>
				<p>'We have received your payment. Your items will be sent soon.</p>
			<?php }else if($status == 'expired'){ ?>
				<p>Your order has expired and automatically cancelled. Please try to re-order.</p>
			<?php }else if($status == 'failed'){ ?>
				<p>Your payment failed. Please try to re-order again.</p>
			<?php }else{ ?>
				<p>We couldn't reach to you. Please do contact us through this email <a href="mailto:email@gtexport.com">email@gtexport.com</a> or contact us a <a href="{{ $url }}/contact-us">here</a>.</p>
			<?php } ?>
			
		</div>
		<div>
			<table style="font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word; border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 25px;">
				<thead>
					<tr>
						<td style="font-size: 13px; font-weight: bold; text-align: center; padding: 5px 10px; border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;" colspan="2">Your Quotation Details</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px; width:50%;">Quotation Number:</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">{{ $quotation->quotation_number }}</td>
					</tr>
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px; width:50%;">Date:</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;"><?php echo date('d F Y H:i:s', strtotime($quotation->created_at)); ?></td>
					</tr>
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px; width:50%;">Amount:</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">IDR {{ number_format($quotation->price, 2, '.', ',') }}</td>
					</tr>
				</tbody>
			</table>
			<?php /* ?>
			<table style="font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word; border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 25px;">
				<thead>
					<tr>
						<td style="font-size: 13px; font-weight: bold; text-align: center; padding: 5px 10px; border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;">Ship To</td>
						<td style="font-size: 13px; font-weight: bold; text-align: center; padding: 5px 10px; border-bottom: 1px solid #DDDDDD; border-right: 1px solid #DDDDDD;">Bill To</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">{{ $order->order_shipping_address->first_name }} {{ $order->order_shipping_address->last_name }}</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">{{ $order->order_billing_address->first_name }} {{ $order->order_billing_address->last_name }}</td>
					</tr>
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">{{ $order->order_shipping_address->phone_number }}</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">{{ $order->order_billing_address->phone_number }}</td>
					</tr>
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">{{ $order->order_shipping_address->email }}</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">{{ $order->order_billing_address->email }}</td>
					</tr>
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">{{ $order->order_shipping_address->address }}, {{ $order->order_shipping_address->city }}<br />
							{{ $order->order_shipping_address->province }}, {{ $order->order_shipping_address->postal_code }}</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">{{ $order->order_billing_address->address }}, {{ $order->order_billing_address->city }}<br />
							{{ $order->order_billing_address->province }}, {{ $order->order_billing_address->postal_code }}</td>
					</tr>
				</tbody>
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
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">Bank Trasnter</td>
					</tr>
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px; width:50%;">Amount:</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px; width:50%;">IDR {{ number_format($order->total_price,0,",",".") }}</td>
					</tr>
				</tbody>
			</table>
			<?php */ ?>
			<div style="margin-bottom: 5px;font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
				<p style="font-weight:bold;">
				Receipt for Your Quotation
				<br />
				Quotation No #{{ $quotation->quotation_number }} </p>
			</div>

			<table style="font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word; border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD;">
				<tr>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 10px;" colspan="3">
					Product
					</td>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 10px 20px 10px 10px;" colspan="3">Quantity</td>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 10px;"> Amount </td>
				</tr>
					<tr>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding:5px 10px;" colspan="3"> {{ $quotation->product->name }}
						</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding:5px 10px;;" colspan="3">x 1</td>
						<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding:5px 10px;">{{ number_format($quotation->price, 2, '.', ',') }}
						</td>
					</tr>
				<?php /* ?>
				<tr>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px;" colspan="3"></td>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px;" colspan="3">Subtotal</td>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px;">IDR {{ number_format($order->sub_total,0,",",".") }} </td>
				</tr>
				<tr>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px;" colspan="3"></td>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px;" colspan="3">Delivery</td>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px;">IDR {{ number_format($order->shipping_fee,0,",",".") }} </td>
				</tr>
				@if($order->discount_price > 0)
				<tr>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px;" colspan="3"></td>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px;" colspan="3">Discount</td>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px;">IDR {{ number_format($order->discount_price,0,",",".") }} </td>
				</tr>
				@endif
				<?php */ ?>
				<tr>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 5px 10px;" colspan="3"></td>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px;" colspan="3"><b> Total</b></td>
					<td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 5px 10px;"><b>IDR {{ number_format($quotation->price,0,",",".") }}</b></td>
				</tr>
			</table>
			<p>Disclaimer : Shipping cost is an estimate and is subject to change</p>
		</div>
		<div style="font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
			<div style="margin-bottom: 5px;">
				<p> As usual, if you have any questions, you may visit our <a href="{{ $url }}/faq">FAQ page</a>, or reply to this email for more enquiries at <a href="mailto:cs.gtexport@gmail.com">cs.gtexport@gmail.com</a> </p>
				<p><a href="tel:+6596178716"><img width="5%" src="{{ asset('images/whatsapp-icon.png') }}"></a></p>
			</div>
		</div>
	</div>
</body>
</html>