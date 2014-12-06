<?php
	/* This PHP file contains all the neccisary loading for all the pages */

	if (version_compare(PHP_VERSION, '5.3.7', '<')) {
		exit("You must run PHP on atleast version 5.3.7 to allow for password secuirty.");
	} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
		require_once("assets/password_compatibility_library.php");
	}

	// Handles login status
	$login = new Login();

	// Gratar intergration to load email from sessions and display
	$email = $_SESSION['user_email'];
	$default = "http://dev.gunsdaily.net/assets/img/avatar.jpg";
	$size = 120;

	$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
	function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
	    $url = 'http://www.gravatar.com/avatar/';
	    $url .= md5( strtolower( trim( $email ) ) );
	    $url .= "?s=$s&d=$d&r=$r";
	    if ( $img ) {
	        $url = '<img src="' . $url . '"';
	        foreach ( $atts as $key => $val )
	            $url .= ' ' . $key . '="' . $val . '"';
	        $url .= ' />';
	    }
	    return $url;
	}

	// Navbar logged in status
	if ($login->isUserLoggedIn() == true) {
	   $navlogin = "Welcome <b>" . $_SESSION['user_name'] . "&nbsp;</b>&nbsp;<img class='account-avatar' width='30px' src='" . $grav_url . "'>";
	   $loginH1DisplayTag = "Welcome <b>" . $_SESSION['user_name'] . "&nbsp;</b>&nbsp;<img class='account-avatar' src='" . $grav_url . "'>";

	} else {
	    $navlogin = "Login";
	    $loginH1DisplayTag  = "Login";

	}

	// UUID Check
//	$uuidLength = $_SESSION['user_uuid'];
//	if (strlen($uuidLength) > 0) {
//	    $isVerified = true;
//	} else {
//	    $isVerified = false;
//	}

//	if ($isVerified == true) {
//	    $VerifiedBoxDisplay = array(
//	    "btn-success verified",
//	    "verified");
//	} else {
//	    $VerifiedBoxDisplay = array(
//	    "btn-danger notverified",
//	    "verified");
//	}

?>