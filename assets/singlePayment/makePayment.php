<?php
	require 'createPayment.php';
	header('Location: '.createPayment($_POST['amount'],$_POST['currency'],$_POST['description']));
?>