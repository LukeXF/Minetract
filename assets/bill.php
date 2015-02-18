<?php 
require 'billing.php';

date_default_timezone_set('UTC');

header('Location: '.createAgreement($_POST['name'], $_POST['description'], $_POST['paymentID']));
?>

<form action="bill.php" method="POST">
	<input type="hidden" value="MT Business Plan" name="name">
	<input type="hidden" value="MT Business Plan" name="description">
	<input type="hidden" value="P-3L574240YY371262Y6ANDOAY" name="paymentID">
	<button type="submit"></button>
</form>