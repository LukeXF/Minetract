<?php

/*
	if the admin is logged in then display the data else do not display anything for added security
*/
if ($login->isUserLoggedIn() == true) {


	// Set's defined names into connection variable to work with the more securer PDO connection
	$userdb = DB_USER;
	$passdb = DB_PASS;
	$hostdb = DB_HOST;
	$namedb = DB_NAME;

	// Creates the array where the order SQL data is stored
	$totalUsers = array();
	$newUsersToday = array();

	// Loads all SQL data and then puts that information into the already created array
	try {
		// Connect and create the PDO object
		$conn = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
		$conn->exec("SET CHARACTER SET utf8");      // Sets encoding UTF-8

		// Define and perform the SQL SELECT query
		$sql  = "SELECT * FROM `users`";
		$sql2 = "SELECT * FROM `users` WHERE `user_date_joined` >= SYSDATE() - INTERVAL 1 DAY";
		$sql3 = "SELECT * FROM `users` WHERE `user_date_joined` >= SYSDATE() - INTERVAL 1 MONTH";

		/* 
			Because it was too confusing to make it through an array from the main array file for total users 
			this system basically queries the SQL each time to and then places into a new array called $accountTypeArray
			and then stores the max registered for there.
		*/
		$accountTypeArray = array();
			$typesql0 = $conn->query("SELECT `user_email`, `user_account_type` FROM `users` WHERE `user_account_type` = 0");
			$typecount0 = 0; while($row = $typesql0->fetch(PDO::FETCH_ASSOC)) {	$typecount0++; } $accountTypeArray["Banned"] = $typecount0;

			$typesql1 = $conn->query("SELECT `user_email`, `user_account_type` FROM `users` WHERE `user_account_type` = 1");
			$typecount1 = 0; while($row = $typesql1->fetch(PDO::FETCH_ASSOC)) {	$typecount1++; } $accountTypeArray["Normal"] = $typecount1;
			
			$typesql2 = $conn->query("SELECT `user_email`, `user_account_type` FROM `users` WHERE `user_account_type` = 2");
			$typecount2 = 0; while($row = $typesql2->fetch(PDO::FETCH_ASSOC)) {	$typecount2++; } $accountTypeArray["Business"] = $typecount2;
			
			$typesql3 = $conn->query("SELECT `user_email`, `user_account_type` FROM `users` WHERE `user_account_type` = 3");
			$typecount3 = 0; while($row = $typesql3->fetch(PDO::FETCH_ASSOC)) {	$typecount3++; } $accountTypeArray["Joint"] = $typecount3;
			
			$typesql4 = $conn->query("SELECT `user_email`, `user_account_type` FROM `users` WHERE `user_account_type` = 4");
			$typecount4 = 0; while($row = $typesql4->fetch(PDO::FETCH_ASSOC)) {	$typecount4++; } $accountTypeArray["Admin"] = $typecount4;




		// Connects to the database table and query SQL then sets the result to a variable
		$result = $conn->query($sql);
		$result2 = $conn->query($sql2);
		$result3 = $conn->query($sql3);

		// Create the array the stores the user table
		$useri = 0;
		while($row = $result->fetch(PDO::FETCH_ASSOC)) {
			$totalUsers[ "User " . $useri] ["user_id"] = $row['user_id']; 
			$totalUsers[ "User " . $useri] ["user_name"] = $row['user_name'];
			$totalUsers[ "User " . $useri] ["user_last"] = $row['user_last']; 
			$totalUsers[ "User " . $useri] ["user_email"] = $row['user_email'];
			$totalUsers[ "User " . $useri] ["user_type"] = $row['user_account_type']; 
			$totalUsers[ "User " . $useri] ["user_date"] = $row['user_date_joined']; 
			$useri++;
		}

		// counts all new registered users today
		$useri2 = 0;
		while($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
			$newUsersToday["User" . $useri2] = $row2['user_email'];
			$useri2++;
		}

		// counts all new registered users this month
		$useri3 = 0;
		while($row3 = $result3->fetch(PDO::FETCH_ASSOC)) {
			$newUsersMonth["User" . $useri3] = $row3['user_email'];
			$useri3++;
		}

		// Disconnect
		$conn = null;
	}
	// Returns any exceptions or errors that my code will not get...
	catch(PDOException $e) {
		echo $e->getMessage();
	}

} else {
	// If the user is not logged in then do not give them access to any of this.
}