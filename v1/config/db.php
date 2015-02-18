<?php

	/**
	 * Configuration for: Database Connection
	 *
	 * DB_HOST: database host, usually it's "127.0.0.1" or "localhost", some servers also need port info
	 * DB_NAME: name of the database.
	 * DB_USER: user for your database. the user needs to have rights for SELECT, UPDATE, DELETE and INSERT.
	 * DB_PASS: the password of the above user
	 */

	define("DB_HOST", "localhost");
	define("DB_NAME", "minetract");
	define("DB_USER", "minetract");
	define("DB_PASS", "minetract615218009");

	// creates an varible to display the fully true url of the web page
	$url = explode('.', $_SERVER['SERVER_NAME']);
	//	$fullUrl = "http://" . $url[0] . "." . $url[1] . "." . "net/";
	$fullUrl = "http://mt.luke.sx";
?>

<?php
	// static configuration for the page ready to switch over into the active system later
	$debug 		= true;
	$shutdown 	= false;

	// static user that will load the SESSION login later on
	$user = array(
		'id' 	=> 1, 
		'first' => 'Luke', 
		'type'	=> '6' 
	);



?>
