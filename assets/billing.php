<?php
	function getAT(){
		$ch = curl_init();
		$clientID = "AWzcgRChU-3FmBZUWpQkBpJjZa80UGghE0dfNbkni7AykunMAmLal33MXqDm";
		$secret = "EGt_ExA4ZB6-aqZg0pJT73QCjQB0fDr6b7tWK6X1zOY0hRQ_PdNk_SjAxayK";

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
	 		return $access_token;
	 	} else {
	 		echo "Nothing to see here";
	 	}

		curl_close($ch);
	}
	function createAgreement($name, $description, $paymentID){
		$start_date = gmdate('Y-m-d\\TG:i:s\\Z', strtotime('+1 hour'));
		$data = '{"name":"'.$name.'","description":"'.$description.'","start_date":"'.$start_date.'","plan":{"id":"'.$paymentID.'"},"payer":{"payment_method":"paypal"}}';
		$access_token = getAT();

		$headers = array(
			"Content-Type:application/json",
			"Authorization: Bearer ".$access_token
		);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/billing-agreements");
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$resultTwo = curl_exec($ch);

		if(isset($resultTwo)){
			//echo "Hi";
			$substrPos = stripos($resultTwo,"{");
			$result = substr($resultTwo, $substrPos);
			$result = json_decode($result);
			$links_array = $result->links;
 			$approvalLink = $links_array[0]->href;
 			return $approvalLink;
		} else {
		 	echo "Nothing to see here";
 		}
 		curl_close($ch);
	}
?>