<?php
	require 'billing.php';

	function cancalPlan($agreementID){
		$access_token = getAT();
	 		$d = "curl -v POST https://api.sandbox.paypal.com/v1/payments/billing-agreements/".$agreementID."/cancel \ ";
	 		$a = "-H 'Content-Type:application/json' \ ";
	 		$t = "-H 'Authorization: Bearer ".$access_token."' \ ";
	 		$ah= "-d '{"."note:"."Canceling the agreement."."}'";
	 		shell_exec($d.$a.$t.$ah);
	}
	cancalPlan("I-ENCCBVBBNPP4");
?>