<?php
	if (version_compare(PHP_VERSION, '5.3.7', '<')) {
	    exit('Sorry, this script does not run on a PHP version smaller than 5.3.7 !');
	} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
	    require_once('lib/password_compatibility_library.php');
	}

	require_once('lib/config.php');
	require_once('translations/en.php');
	require_once('classes/Login.php');
	require_once('classes/SiteFunctions.php');
	require_once('classes/News.php');

	$login = new Login();
	$SiteFunctions = new SiteFunctions();
	$news = new News();

	// the logo file located in the assets folder (inside config to edit the logo)
	$logo = $domain . "assets/img/" . $logo;

	                    
	// show potential errors / feedback (from login object)
	    if ($SiteFunctions->errors) {
	        foreach ($SiteFunctions->errors as $error) {
	            echo $error;
	        }
	    }


	$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $_SESSION['user_email'] ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size; 

	$navlogin = "Welcome <b>" . $_SESSION['user_name'] . "</b>";

	$navbar = array(
		/*"Contact" =>   array(
			"active" => "",
			"url" => "#",
			"submenu" => array()
		),

		"Purchase $brand" => array(
			"active" => "",
			"url" => "#",          
			"submenu" => array()
		)*/

	);
	if ($login->isUserLoggedIn() == true) {
		$navbar2 = array(
			"Follow Us" =>   array(
				"active" => "",
				"url" => "https://twitter.com/ElementsWorks' target='_blank",
				"submenu" => array()
			),

			"$navlogin" => array(
				"active" => "",
				"url" => "",          
				"submenu" => array(
					"Summary" => "login" . $dotPHP,
					"logout"  => "?logout"
				)
			)
		);

	} else {
		$navbar2 = array(
			"Register" =>   array(
				"active" => "",
				"url" => $domain . "register" . $dotPHP,
				"submenu" => array()
			),

			"Login" => array(
				"active" => "",
				"url" => $domain . "login" . $dotPHP,          
				"submenu" => array()
			)
		);
	}

	// sets the title of the page via the 
	$titleName = ucfirst(basename($_SERVER['PHP_SELF'],'.php'));

	if (!empty($overrideTitleName)) {
		$titleName = $overrideTitleName;
	} elseif ($titleName == "Index") {
		$titleName = "Home";
	}
?>

<html>
	<head>
	    <meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="<?php echo $brand; ?>">
		<meta name="author" content="Luke Brown, <?php echo $email; ?>">

	    <title><?php echo $SiteFunctions->setPageTitle() ?></title>

		<link rel="stylesheet" type="text/css"  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:700,400|Raleway:400,300|Montserrat' rel='stylesheet' type='text/css'>
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo $domain; ?>assets/css/style.css">
		<link rel="icon" type="image/png" href="<?php echo $logo; ?>">


		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
		<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</head>


	<script type="text/javascript">
		$(function () {
		$('[data-toggle="tooltip"]').tooltip()
		})
		$(document).ready(function() {
		    $('body').tooltip({
		        selector: "[data-tooltip=tooltip]",
		        container: "body"
		    });
		});
	</script>




