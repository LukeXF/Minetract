<?php

	$brand = "Minetract";
	// gravtar image size:
	$size = '256';
	$email = "me@luke.sx";


	// detect if on local testing 
	$localhost = array(
    	'127.0.0.1',
    	'::1',
    	'localhost'
	);	

    // if on local testing add .php to all the links
    // this is so that when on a production enviroment
    // it will remove all .php from the .htaccess rewrite
	if(!in_array($_SERVER['REMOTE_ADDR'], $localhost)){

    	$dotPHP = "";
		$domain = "http://dev.minetract.net/";

		$config = array(
			'admin_username' => 'admin', // username used to login to the admin area
			'admin_password' => 'admin', // password used to login to the admin area

			'db_host' => 'localhost', // database host, usually localhost
			'db_username' => 'gateway', // database username
			'db_password' => 'jz9QMc4uzqstcW5f', // datebase password
			'db_name' => 'gateway', // database name
		);

	} else {

		$dotPHP = ".php";
		$domain = "http://localhost/minetract/";

		$config = array(
			'admin_username' => 'admin', // username used to login to the admin area
			'admin_password' => 'admin', // password used to login to the admin area

			'db_host' => 'localhost', // database host, usually localhost
			'db_username' => 'gateway', // database username
			'db_password' => 'HsmGCtdKC7RnC2SX', // datebase password
			'db_name' => 'gateway', // database name
		);

	}




	
	// legacy config for where the arrays cannot inputted.
	define("DB_HOST", $config['db_host']);
	define("DB_NAME", $config['db_username']);
	define("DB_USER", $config['db_name']);
	define("DB_PASS", $config['db_password']);


	define("COOKIE_RUNTIME", 1209600);
	define("COOKIE_DOMAIN", $domain);
	define("COOKIE_SECRET_KEY", "1gp@TMPS{+$78sfpMJFe-92s");


	define("HASH_COST_FACTOR", "10");
?>