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

function createPayment($amount, $currency, $description){
	$access_token = getAT();
	$ch = curl_init();
	$payment = '{"intent":"sale","redirect_urls":{"return_url":"http://minetract.net/assets/singlePayment/return.php","cancel_url":"http://minetract.net/marketplace"},"payer":{"payment_method":"paypal"},"transactions":[{"amount":{"total":"'.$amount.'","currency":"'.$currency.'"},"description":"'.$description.'"}]}';

	$headers = array(
		"Content-Type:application/json",
		"Authorization: Bearer ".$access_token
	);

	curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payment");
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPGET, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $payment);

	$resultTwo = curl_exec($ch);
 	if(isset($resultTwo)){
 		//print_r($resultTwoSubStr);
 		$substrPos = stripos($resultTwo,"{");
		$result = substr($resultTwo, $substrPos);
		$resultTwoSubStr = json_decode($result);
 		$links_array = $resultTwoSubStr->links;
 		$approvalLink = $links_array[1]->href;
 		$paymentID = $resultTwoSubStr->id;
 		return $approvalLink;
 	} else {
 		echo "Nothing to see here";
 	}

	curl_close($ch);
}

function sendPayment($amount, $currency, $paypalID, $description){
	$access_token = getAT();
	$amount = (double) $amount;
	$mtCut = (($amount/100)*5);
	$paymentAmount = ($amount - $mtCut);
	$paymentAmount = round($paymentAmount, 2);
	$data = '{"sender_batch_header":{"email_subject":"You have been payed!"},"items":[{"recipient_type":"PAYPAL_ID","amount":{"value":'.$paymentAmount.',"currency":"'.$currency.'"},"receiver":"'.$paypalID.'","note":"'.$description.'"}]}';

	$ch = curl_init();
$headers = array(
		"Content-Type:application/json",
		"Authorization: Bearer ".$access_token
	);

	curl_setopt($ch, CURLOPT_URL, "https://api.sandbox.paypal.com/v1/payments/payouts?sync_mode=true");
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_HTTPGET, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	
	$result = curl_exec($ch);
	if(isset($result)){
 		print_r($result);
 	} else {
 		echo "Nothing to see here";
 	}
	curl_close($ch);
}
?>