<?php

/*
	if the user is logged in the display the order array
	this is important because the SQL query loads the entered
	session user_id. If they are not logged in the session is
	none existant and therefor an SQL error will occur if the
	isUserLoggedIn check is not performed
*/
if ($login->isUserLoggedIn() == true) {


	// Set's defined names into connection variable to work with the more securer PDO connection
	$userdb = DB_USER;
	$passdb = DB_PASS;
	$hostdb = DB_HOST;
	$namedb= DB_NAME;

	// Creates the array where the order SQL data is stored
	$productsInArray = array();

	// Loads all SQL data and then puts that information into the already created array
	try {
		// Connect and create the PDO object
		$conn = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
		$conn->exec("SET CHARACTER SET utf8");      // Sets encoding UTF-8

		// Define and perform the SQL SELECT query
		 $sql2 = "SELECT * FROM `content` WHERE `user_id` =  " . $_SESSION['user_id'];
		// Connects to the database table and query SQL then sets the result to a variable
		$result2 = $conn->query($sql2);

		// Creates the array that stores each product inside the order table belonging to the use selected
		while($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
			$productsInArray[ "Content " . $row2['content_id'] ] ["Belongs to order"] = $row2['content_order_id'];
			$productsInArray[ "Content " . $row2['content_id'] ] ["Product"] = $row2['content_stock_id'];
			$productsInArray[ "Content " . $row2['content_id'] ] ["Quantity"] = $row2['content_quantity'];
			$productsInArray[ "Content " . $row2['content_id'] ] ["For User"] = $row2['user_id'];
		}

		// Disconnect
		$conn = null;
	}
	// Returns any exceptions or errors that my code will not get...
	catch(PDOException $e) {
		echo $e->getMessage();
	}

	$finalOrderList = array();

	// Counts the total amount of orders that user has
	$countTotalOrders = (count($orderArray));

	while($counterforOrders <= $countTotalOrders) {
		$finalOrderList[ 'Order ' . $counterforOrders ] ["OrderInfo"] ["d"] = "$countTotalOrders";
		//$finalOrderList[ 'Order ' . $counterforOrders ] ["OrderInfo"] ["a"] = $orderArray["OrderInfo 3"]["date"];
	}

} else {
	// Work as usual boys.
}