<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>RECOVER/FORGET PASSWORD</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #000000;line-height: 24px;">
	<div style="width:600px;margin:0 auto;background-color:transparent;text-align:center;">
		<div style="text-align: center;padding: 10px 0;">
			<a href="{{ $url }}">
				<img src="{{ $url }}/images/logo.png" />
			</a>
		</div>
		<div style="margin-bottom: 20px; font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
			<p>Hi {{ $email }},</p>
		</div>
		<div style="margin-bottom: 10px;font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
			<p>Reset your password, and we’ll get you on your way.</p>
		</div>
		<div style="font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
			<p style="margin-bottom: 0;">To change your password, click the link or paste the following link into your browser:</p>
			<a style="color: #0080ff;" href="{{ $link }}" target="_blank">{{ $link }}</a>
		</div>
		<div style="font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
			<p style="margin-bottom: 0;">In any case password change is not required, please proceed directly to the link provided to login.</p>
			<a style="color: #0080ff;" href="{{ $url }}/login" target="_blank">{{ url('/') }}/login</a>
		</div>
		<div style="font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
			<p style="margin-bottom: 0;">If problems still persist, please feel free to contact member of our support at</p>
			<a style="color: #0080ff;" href="mailto:email@gtexport.com" target="_blank">email@gtexport.com</a>
		</div>
	</div>
</body>
</html>