<?php
	date_default_timezone_set('UTC');
	// Sets the values for the navbar
	$navbar = array(
		"Dashboard" =>   array(
			"active" => "",
			"url" => "index.php",
			"submenu" => array()
		),

		"orders" =>  array(
			"active" => "",
			"url" => "orders.php",          
			"submenu" => array()
		),

		"users" =>  array(
			"active" => "",
			"url" => "users.php",          
			"submenu" => array()
		),

		"advertise" => array(
			"active" => "",
			"url" => "advertise.php",          
			"submenu" => array()
		),

		"products" => array(
			"active" => "",
			"url" => "products.php",          
			"submenu" => array()
		)

	)
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<title>Guns Daily Admin</title>

<!-- ////////////////////////////////////
	HEADER LINKS
///////////////////////////////////// -->

	<meta name="description" content="A beautiful image and screenshot sharing application from desktop to the web in seconds">
	<meta name="author" content="Luke Brown">
	<meta charset="utf-8">
	<link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700|Viga|Courgette|Open+Sans:400italic,400,300,600,700' rel='stylesheet' type='text/css'>
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<link rel="shortcut icon" href="<?php echo $fullUrl; ?>assets/img/icon.png" />

	<link rel="stylesheet" href="<?php echo $fullUrl; ?>assets/css/bootstrap.css">
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo $fullUrl; ?>assets/css/style.css">
	<script src="<?php echo $fullUrl; ?>assets/js/slippry.min.js"></script>
	<script src="http://listjs.com/no-cdn/list.js"></script>
	<script src="//use.edgefonts.net/cabin;source-sans-pro:n2,i2,n3,n4,n6,n7,n9.js"></script>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" Content-Type:"text/css" href="<?php echo $fullUrl; ?>assets/css/slippry.css">
</head>


<!-- ////////////////////////////////////
	BEGIN BODY
///////////////////////////////////// -->

<body>
