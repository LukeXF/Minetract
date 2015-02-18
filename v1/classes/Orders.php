<?php

/*
	if the user is logged in the display the order array
	this is important because the SQL query loads the entered
	session user_id. If they are not logged in the session is
	none existent and therefor an SQL error will occur if the
	isUserLoggedIn check is not performed
*/
if ($login->isUserLoggedIn() == true) {


	// Set's defined names into connection variable to work with the more securer PDO connection
	$userdb = DB_USER;
	$passdb = DB_PASS;
	$hostdb = DB_HOST;
	$namedb = DB_NAME;

	// Creates the array where the order SQL data is stored
	$productsInArray = array();

	// Loads all SQL data and then puts that information into the already created array
	try {
		// Connect and create the PDO object
		$conn = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
		$conn->exec("SET CHARACTER SET utf8");      // Sets encoding UTF-8

		// Define and perform the SQL SELECT query
		$sql  = "SELECT * FROM `orders`  WHERE `user_id` =  " . $_SESSION['user_id'];
		$sql2 = "SELECT * FROM `content` WHERE `user_id` =  " . $_SESSION['user_id'];
		//$sql = "SELECT * FROM `orders` WHERE `user_id` = 1";
		// Connects to the database table and query SQL then sets the result to a variable
		$result = $conn->query($sql);
		$result2 = $conn->query($sql2);

		// Create the array the stores the order information belonging to the use selected
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$orderArray[ "OrderInfo " . $row['order_id']] ["date"]           = $row['order_date'];
			$orderArray[ "OrderInfo " . $row['order_id']] ["status"]         = $row['order_status'];
			$orderArray[ "OrderInfo " . $row['order_id']] ["user_comments"]  = $row['order_user_comments'];
			$orderArray[ "OrderInfo " . $row['order_id']] ["admin_comments"] = $row['order_admin_comments'];
			$orderArray[ "OrderInfo " . $row['order_id']] ["user_id"]        = $row['user_id'];
			$orderArray[ "OrderInfo " . $row['order_id']] ["order_id"]       = $row['order_id']; 
		}

		// Creates the array that stores each product inside the order table belonging to the use selected
		while($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
	        $productsInArray[ "Content " . $row2['content_id'] ] ["Belongs to order"] = $row2['content_order_id'];
	        $productsInArray[ "Content " . $row2['content_id'] ] ["Product"]          = $row2['content_stock_id'];
	        $productsInArray[ "Content " . $row2['content_id'] ] ["Quantity"]         = $row2['content_quantity'];
	        $productsInArray[ "Content " . $row2['content_id'] ] ["For User"]         = $row2['user_id'];
	        $productsInArray[ "Content " . $row2['content_id'] ] ["Store Price"]      = $row2['store_price'];
		    
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
	// Set to one so the the order number can be correctly displayed
	$counterforOrders = 1;
	// Changes the human associative values back to individual numbers for the key values in the array
	$numsOrderArray = array_keys($orderArray);


	while($counterforOrders <= $countTotalOrders) {




		/////////////////////////////////////////////////////
		/* IMPORTING THE ORDER INFO ARRAY INTO FINAL ARRAY */

			// Uses the non-associative array for the orders array
			$numsOrderArray[0];
			// Makes non-associative array of the original order SQL array
			$keysOrderArray = array_keys($orderArray);
			// Sets the counter to start on one to zero for the variable to string to work.
			$newCounter = ($counterforOrders) - 1;
			// convert the non-associative array key value into a string so it can be loaded through the while loop
			$variableToString = (string)$keysOrderArray[$newCounter];
			// Gets the order_id numbers for the order array and displays it under the nested finalOrderArray
			$finalOrderID = $orderArray[$variableToString]['order_id'];

			// Simply places the order info into the nested product array
			$finalOrderList[ 'Order ' . $counterforOrders ] ["OrderInfo"] ["order_id"]       = $finalOrderID;
			$finalOrderList[ 'Order ' . $counterforOrders ] ["OrderInfo"] ["date"]           = $orderArray[$variableToString]['date'];
			$finalOrderList[ 'Order ' . $counterforOrders ] ["OrderInfo"] ["status"]         = $orderArray[$variableToString]['status'];
			$finalOrderList[ 'Order ' . $counterforOrders ] ["OrderInfo"] ["user_comments"]  = $orderArray[$variableToString]['user_comments'];
			$finalOrderList[ 'Order ' . $counterforOrders ] ["OrderInfo"] ["admin_comments"] = $orderArray[$variableToString]['admin_comments'];





		/////////////////////////////////////////////////////
		/* IMPORTING THE ORDER INFO ARRAY INTO FINAL ARRAY */


			// Makes non-associative array of the original products SQL array (sets words to numbers)
			$keysProductsArray = array_keys($productsInArray);

			// Sets the counter for the while loop
			$productsInOrderCounter = 0;

			// Sets a variable that counts all the products inside the product array
			$productsCounter = count($productsInArray);

			/* 
				While the counter the increments by one each loop is less than the total 
				amount of products for that user then loop through. This is stop the code
				from becoming crazy big if there is an error, it will limit it to the amount
				of products inside every single order that the use has ordered compared to
				just going on and on and on at like 100,000 line of output code per second
				like it did for three day straight.
			*/

			// Sets the product number key
			$productNumberCounter = 0;

			while ($productsInOrderCounter < $productsCounter) {

				/* 
					If the product array (the non-associative variable type) while looping through each and every product
					belongs to that order then insert it inside the ProductInfo nested array. This will return the product
					number and the amount of products that have been purchased.
				*/
				if ($productsInArray[$keysProductsArray[$productsInOrderCounter] ]["Belongs to order"] == $finalOrderID) {

					// Loads the product number from the shop and the amount ordered into a variable.
					$productNumber = ($productsInArray[$keysProductsArray[$productsInOrderCounter] ]["Product"]);
					$productAmount = ($productsInArray[$keysProductsArray[$productsInOrderCounter] ]["Quantity"]);
					$productPrice = ($productsInArray[$keysProductsArray[$productsInOrderCounter] ]["Store Price"]);

					// Simply places the product info into the nested product array
					$finalOrderList[ 'Order ' . $counterforOrders ] ["ProductInfo"] ["Product " . $productNumberCounter] ["Product Number"] = $productNumber;
					$finalOrderList[ 'Order ' . $counterforOrders ] ["ProductInfo"] ["Product " . $productNumberCounter] ["Quantity"] = $productAmount;
					$finalOrderList[ 'Order ' . $counterforOrders ] ["ProductInfo"] ["Product " . $productNumberCounter] ["Price"] = $productPrice;

					// Increments the product key number
					$productNumberCounter++;
				}

				// This line wasted three days of my life for missing it out.
				$productsInOrderCounter++;
			}
			
			// Resets the product key number for the next order.
			$productNumberCounter = 0;

		// Increments the final order array counter
		$counterforOrders++;
	}

} else {
	// If the user is not logged in then do not give them access to any of this.
}