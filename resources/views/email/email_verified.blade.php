<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ACCOUNT ACTIVATION</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #000000;line-height: 24px;">
	<div style="width:600px;margin:0 auto;background-color:transparent;text-align:center;">
		<div style="text-align: center;padding: 10px 0;">
			<a href="{{ $url }}">
				<img src="{{ $url }}/images/logo.png" />
			</a>
		</div>
		<div style="margin-bottom: 20px;font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
			<p>Dear {{ $name }},</p>
		</div>
		<div style="margin-bottom: 10px;font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
			<p>Thank you for creating an account with us.</p>
		</div>
		<div style="margin-bottom: 10px;font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
			<p>To activate your account, please complete the verification using the URL below: </p>
			<a style="color: #0080ff;" href="{{ $link }}" target="_blank">{{ $link }}</a>
		</div>
		<div style="margin-bottom: 10px;font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
			<p>If the above URL does not work, please copy the URL above and paste onto your web browser.</p>
		</div>
		<div>
			<p style="margin-bottom: 10px;font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">If you have any questions, you may visit our <a href="{{ $url }}/faq">FAQ page</a>, or contact us at <a href="mailto:cs.gtexport@gmail.com">cs.gtexport@gmail.com</a>.
			</p>
			<p><a href="https://wa.me/6596754433"><img width="5%" src="{{ asset('images/whatsapp-icon.png') }}"></a></p>
		</div>
	</div>
</body>
</html>