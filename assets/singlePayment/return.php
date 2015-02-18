<?php
	require 'createPayment.php';

	$parts = parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
	parse_str($parts['query']);
	$paymentID = $paymentId;
	$payerID = $PayerID;

	$ch = curl_init();
	$clientID = "AcLjORDY4S2gzEb-zpp00JDbXcKqzWAjJwoKELrYKI9M3obQLUcTmxzYr2bN";
	$secret = "EM-ZQxAamiPsBRUgqZOCER3Ugdtep9_GFtvQmoKuX91LT9k0O-ceERJcshCO";

	curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/oauth2/token");
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_USERPWD, $clientID.":".$secret);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "grant_type=client_credentials");

 	$result = curl_exec($ch);

 	if(isset($result)){
 		$access_token = json_decode($result)->access_token;
 	} else {
 		echo "Nothing to see here";
 	}

	curl_close($ch);

	$ch = curl_init();

	$headers = array(
		"Content-Type:application/json",
		"Authorization: Bearer ".$access_token
	);

	curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payment/".$paymentID."/execute/");
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPGET, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_POSTFIELDS, '{ "payer_id" : "'.$payerID.'" }');

	$resultTwo = curl_exec($ch);
 	if(isset($resultTwo)){
 		print_r($resultTwo);
 	} else {
 		echo "Nothing to see here";
 	}

	curl_close($ch);

	sendPayment("4.99", "GBP", "markhamg7@gmail.com", "You got paid for some work!");
?>