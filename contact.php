<?php 
	$errors = '';
	if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
	    $errors .= "\n Error: all fields are required";
	}
	$name = $_POST['name']; 
	$email_address = $_POST['email']; 
	$message = $_POST['message']; 
	$redirect = $_POST['redirect'];
	if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $email_address)) {
	    $errors .= "\n Error: Invalid email address";
	}
	if(empty($errors)) {
		$email_subject = "New Contact: $name";
		$email_body = "<strong>New contact received!</strong><br><br>\r\n\r\n".
						"Name: $name <br>\r\n".
						"Email: $email_address<br>\r\n".
						"Message: $message";
		$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: Matt Douglas <md@ivytech.co>' . "\r\n"; 
		//$headers .= "Reply-To: $email_address";
		mail('mrdouglas83@gmail.com',$email_subject,$email_body,$headers);
		//if (!substr($redirect, 0, 4) == 'file') {
		//	header("Location: $redirect");
		//}
	} 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
<?php
	if(empty($errors)) {
		echo('<title>Thanks!</title>');
	} else {
		echo('<title>Error!</title>');
	}
?>
<style>
	body {
		margin: 20px;
		background-color: #ffffff;
		font-size: 14px;
		color: #777777;
		font-family: 'Arial', 'Helvetica Neue', Helvetica, sans-serif;
		line-height: 1.25;
	}
	h1 {
		color: #4aaaa5;
		font-size: 28px;
		font-weight: bold;
		margin: 0 auto;
		padding: 0px 0px 25px 0px;
		font-family: 'Georgia', Times, Times New Roman, serif;
	}
	a {
		border: none;
		color: #aaaaaa;
		font-size: 16px;
		font-family: 'Arial', 'Helvetica Neue', Helvetica, sans-serif;
		font-weight: bold;
		text-decoration: none;
	}
	a:hover {
		color: #4aaaa5;
	}
	a:active {
		color: #4aaaa5;
	}
	.msg {
		margin: 0px 0px 20px 10px;
		background-color: #ffffff;
		font-size: 14px;
		color: #997788;
		font-family: 'Arial', 'Helvetica Neue', Helvetica, sans-serif;
		line-height: 1.5;
	}
</style>
</head>
<body>
<?php
	if(empty($errors)) {
		echo('<h1>Thanks for your message!</h1>');
		echo('<div class="msg">');
		echo("<strong>Name:</strong> $name <br>\r\n");
		echo("<strong>Email:</strong> $email_address<br>\r\n");
		echo("<strong>Message:</strong> $message<br>\r\n");
		echo('</div>');
	} else {
		echo nl2br($errors);
		echo("<br>\r\n<br>\r\n");
	}
	echo('<a href="' . $redirect .'">Back to site</a>');
?>
</body>
</html>