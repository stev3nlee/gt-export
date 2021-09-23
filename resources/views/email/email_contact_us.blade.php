<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>CONTACT US</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #000000;line-height: 24px;">
	<div style="width:600px;margin:0 auto;background-color:transparent;text-align:center;">
		<div style="text-align: center;padding: 10px 0;">
			<a href="{{ $url }}">
				<img src="{{ $url }}/images/logo.png" />
			</a>
		</div>
		<div style="margin-bottom: 20px;font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
			<p>Hi Admin,</p>
		</div>
		<div  style="font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
			<p>A customer {{ $name }} sent a contact form.</p>
		</div>
		<div style="font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
			<p>Please check the following details:</p>
			<div style="display: table;width: 100%;">
				<div style="display: table-cell; width: 130px;">Email Address :</div>
				<div style="display: table-cell;">
					<p style="margin: 5px;">{{ $email }}</p>
				</div>
			</div>
			<div style="display: table;width: 100%;">
				<div style="display: table-cell; width: 130px;">Name :</div>
				<div style="display: table-cell;">
					<p style="margin: 5px;">{{ $name }}</p>
				</div>
			</div>
			<div style="display: table;width: 100%;">
				<div style="display: table-cell; width: 130px;">Phone Number :</div>
				<div style="display: table-cell;">
					<p style="margin: 5px;">{{ $phone }}</p>
				</div>
			</div>
			<div style="display: table;width: 100%;">
				<div style="display: table-cell; width: 130px;">Message :</div>
				<div style="display: table-cell;">
					<p style="margin: 5px;">{{ $message_contact }}</p>
				</div>
			</div>
		</div>
		<div style="font-family: HelveticaNeue-Light, Helvetica Neue Light, Helvetica, Arial, sans-serif; font-weight: 300; font-size: 14px; color: #333333; line-height: 22px; text-align: center; mso-margin-top-alt:1px; word-break:break-word;">
			<div style="margin-bottom: 5px;">
				<p> As usual, if you have any questions, you may visit our <a href="{{ $url }}/faq">FAQ page</a>, or contact us at <a href="mailto:email@gtexport.com">email@gtexport.com</a> </p>
			</div>
		</div>
	</div>
</body>
</html>