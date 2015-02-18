<?php
	require_once($mt_path . 'translations/en.php');
	require_once($mt_path . 'libraries/PHPMailer.php');

	// Sets the values for the navbar
	$navbar = array(
		"Features" =>   array(
			"active" => "",
			"url" => $mt_url . "features",
			"submenu" => array()
		),

		"Pricing" => array(
			"active" => "",
			"url" => $mt_url . "pricing",          
			"submenu" => array()
		)

	);
	// Sets the values for the navbar
	$navbar2 = array(
		"Marketplace" =>   array(
			"active" => "",
			"url" => $mt_url . "marketplace",
			"submenu" => array()
		),

		"About" =>   array(
			"active" => "",
			"url" => $mt_url . "about",
			"submenu" => array()
		),

		"News" =>   array(
			"active" => "",
			"url" => $mt_url . "news",
			"submenu" => array()
		),

		"Contact" => array(
			"active" => "",
			"url" => $mt_url . "contact",          
			"submenu" => array()
		)

	);


?>

<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 

		<?php

		// Get the name of the page based off of the URL 
		$titleName = ucfirst(basename($_SERVER['PHP_SELF'],'.php'));

		// if the page name is not empty then display it in the title
		// else assume we're on the page index
		if (!empty($overrideTitleName)) {
			$titleName = $overrideTitleName;
		} elseif ($titleName == "Index") {
			$titleName = "Home";
		}

		?>
		
		<title>Minetract | <?php echo $titleName; ?></title>

		<meta name="description" content="Minetract - your one stop location for Minecraft freelancing and projects" />
		<meta name="keywords" content="minetract, minecraft, mine craft, contracts, freelancing" />
		<meta name="author" content="Jed Palmer, Samuel Oakes, Luke Brown" />
		<link rel="icon" type="image/png" href="<?php echo $mt_url; ?>assets/img/logo-img.png">

		<link href='http://fonts.googleapis.com/css?family=Montserrat|Raleway:300,400' rel='stylesheet' type='text/css'>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

		<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<link rel="stylesheet" type="text/css" href="<?php echo $mt_url; ?>assets/css/style.css" />
		<link rel="stylesheet" type="text/css" href="<?php echo $mt_url; ?>assets/css/component.css" />
		<script src="<?php echo $mt_url; ?>assets/js/modernizr.custom.js"></script>
	</head>

