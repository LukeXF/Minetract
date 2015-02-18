<?php
	require 'billing.php';
	$parts = parse_url("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
	parse_str($parts['query']);

	executePayment($token);

	function executePayment($token){
			$access_token = getAT();
			$headers = array(
				"Content-Type:application/json",
				"Authorization: Bearer ".$access_token
			);
			$ch = curl_init();
			$executeLink = "https://api.sandbox.paypal.com/v1/payments/billing-agreements/".$token."/agreement-execute";
			curl_setopt($ch, CURLOPT_URL, $executeLink);
			curl_setopt($ch, CURLOPT_HEADER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_POSTFIELDS, '{}');
			$resultTwo = curl_exec($ch);

			if(isset($resultTwo)){
				$substrPos = stripos($resultTwo,"{");
				$result = substr($resultTwo, $substrPos);
				$result = json_decode($result);
				//print_r($result);
				//INSERT INTO USER DB AS AGREEMENTID FIELD
				$agreementID = $result->id;
				print_r($agreementID);
			} else {
			 	echo "Something went wrong";
	 		}
	 		curl_close($ch);
	}
?>
