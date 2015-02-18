<?php
	/* 
		Minetract Configuration File
		All static data will be loaded through this page
		Any dynamic data is stored through database connection (PDO MySQL)
		Developered by Luke Brown (me@luke.sx)
	*/


	// detect if on localhost
	$localTesting = array(
	    '127.0.0.1',
	    '::1',
	    'localhost'
	);

	// static configuration and settings
	$debug 		= true;
	$shutdown 	= false;
	$mt_url 	= "http://dev.minetract.net/";
	$mt_brand 	= "Minetract";


	// if the main section of url contains local array values
	if(!in_array($_SERVER['REMOTE_ADDR'], $localTesting)){


		///////////////////////////
		// PRODUCTION STAGE INFO //


		// if we have debug turned on
	    	echo "<script>console.log('Minetract loaded on production stage')</script>";
	    if ($debug) {
	    	echo "<script>console.log('Minetract loaded on production stage')</script>";
			$mt_path = "/var/www/html/luke/demo.luke.sx/minetract/";	
	    }

		// database connection for production environment
			define("DB_HOST", "localhost");
			define("DB_NAME", "mt2");
			define("DB_USER", "minetract");
			define("DB_PASS", "minetract615218009");
	} else {


		///////////////////////////
		// TESTING STAGE INFO //


		// if we have debug turned on
	   		echo "<script>console.log('Minetract loaded on testing stage at address: " .  $_SERVER['REMOTE_ADDR'] . "')</script>";
	    if ($debug) {	
	   		echo "<script>console.log('Minetract loaded on testing stage at address: " .  $_SERVER['REMOTE_ADDR'] . "')</script>";
			$mt_path = "http://localhost/minetract/";
		}

		// database connection for testing environment
		define("DB_HOST", "localhost");
		define("DB_NAME", "minetract");
		define("DB_USER", "root");
		define("DB_PASS", "");
	}

	// creates an variable to display the fully true url of the web page
	// echo $url = explode('.', $_SERVER['SERVER_NAME']);
	// echo $fullUrl = "http://" . $url[0] . "." . $url[1] . "." . "net/";



	// static user that will load the SESSION login later on
	$user = array(
		'id' 	=> 1, 
		'first' => 'Luke', 
		'type'	=> '6' 
	);


	// COOKIE_RUNTIME: How long should a cookie be valid ? 1209600 seconds = 2 weeks
	// COOKIE_DOMAIN: The domain where the cookie is valid for, like '.mydomain.com'
	// COOKIE_SECRET_KEY: Put a random value here to make your app more secure. When changed, all cookies are reset.
	define("COOKIE_RUNTIME", 1209600);
	define("COOKIE_DOMAIN", ".127.0.0.1");
	define("COOKIE_SECRET_KEY", "1gp@TMPS{+$78sfpMJFe-92s");

	// convert to SMTP later on, for now it is fine on standard mail
	define("EMAIL_USE_SMTP", false);
	define("EMAIL_SMTP_HOST", "yourhost");
	define("EMAIL_SMTP_AUTH", true);
	define("EMAIL_SMTP_USERNAME", "yourusername");
	define("EMAIL_SMTP_PASSWORD", "yourpassword");
	define("EMAIL_SMTP_PORT", 465);
	define("EMAIL_SMTP_ENCRYPTION", "ssl");

	/**
	 * Configuration for: password reset email data
	 * Set the absolute URL to password_reset.php, necessary for email password reset links
	 */
	define("EMAIL_PASSWORDRESET_URL", "http://mt.luke.sx/forgot.php");
	define("EMAIL_PASSWORDRESET_FROM", "no-reply@minetract.com");
	define("EMAIL_PASSWORDRESET_FROM_NAME", "Minetract");
	define("EMAIL_PASSWORDRESET_SUBJECT", "Password reset for Minetract");
	define("EMAIL_PASSWORDRESET_CONTENT", "Please click on this link to reset your password:");

	/**
	 * Configuration for: verification email data
	 * Set the absolute URL to register.php, necessary for email verification links
	 */
	define("EMAIL_VERIFICATION_URL", "http://mt.luke.sx/register");
	define("EMAIL_VERIFICATION_FROM", "no-reply@minetract.com");
	define("EMAIL_VERIFICATION_FROM_NAME", "Minetract");
	define("EMAIL_VERIFICATION_SUBJECT", "Account activation for Minetract");
	define("EMAIL_VERIFICATION_CONTENT", "Please click on this link to activate your account:");

	// Higher the number to enable further protection, 10 is fine.
	define("HASH_COST_FACTOR", "10");
?>