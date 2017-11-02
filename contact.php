<?php 
$errors = '';
if(empty($_POST['name'])  || 
   empty($_POST['email']) || 
   empty($_POST['message']))
{
    $errors .= "\n Error: all fields are required";
}

$name = $_POST['name']; 
$email_address = $_POST['email']; 
$message = $_POST['message']; 
$redirect = $_POST['redirect'];

if (!preg_match(
"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", 
$email_address))
{
    $errors .= "\n Error: Invalid email address";
}

if(empty($errors))
{
	$email_subject = "New Contact: $name";
	$email_body = "<strong>New contact received!</strong><br><br>\r\n\r\n".
					"Name: $name <br>\r\n".
					"Email: $email_address<br>\r\n".
					"Message: $message\r\n";
	$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: Matt Douglas <md@ivytech.co>' . "\r\n"; 
	//$headers .= "Reply-To: $email_address";
	
	mail('mrdouglas83@gmail.com',$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	header("Location: $redirect");
} 
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
	<title>Error!</title>
</head>

<body>
<!-- This page is displayed only if there is some error -->
<?php
echo nl2br($errors);
?>


</body>
</html>