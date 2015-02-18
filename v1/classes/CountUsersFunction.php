<?php
	require '/var/www/html/luke/demo.luke.sx/minetract/config/db.php';
	function fieldCount($field,$condition,$table){
		$DB_HOST = DB_HOST;
		$DB_NAME = DB_NAME;
		try{
		    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", DB_USER, DB_PASS);

		    //This turns on the error mode so you get warnings returned, if any
		    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		    $stmt = $dbh->prepare("SELECT $field, COUNT(*) AS count FROM $table $condition GROUP BY $field");

		// I tried to bind my $field variable but for some reason it didn't work so I
		// commented it out below until I can look deeper into it. If anyone sees any
		// glaring errors, please point them out. It looks right to me, but as I said,
		// it's not working.

		//  $stmt = $dbh->prepare("SELECT :field, COUNT(*) AS count FROM $table $condition GROUP BY :field");
		//  $stmt->bindParam(':field', $field);

		    $stmt->execute();

		    $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
		    // Creates an array similar as the following:
		    // $results[0][$field] $results[0]['count']
		    // $results[1][$field] $results[1]['count']
		    // $results[2][$field] $results[2]['count']
		    // with each row as an array of values within a numeric array of all rows

		    $dbh = null;
		}
		catch(PDOException $e)
		{
		echo $e->getMessage();
		}

		return $results;
	}
?>