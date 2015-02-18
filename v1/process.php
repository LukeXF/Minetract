<?php

	// configuration
	$dbtype		= "mysql";
	$dbhost 	= "localhost";
	$dbuser		= "global";
	$dbname		= "shop";
	$dbpass		= "global";


?>
<pre>
<?php print_r($_POST); ?>
</pre>

<?php

// If the user goes to create the shop
if (!empty($_POST['submit'])) {

	// database connection
	$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

	// new data
	$title = 'PHP Security';
	$author = 'Jack Hijack';

	// query
	$sql = "INSERT INTO shops (title,author) VALUES (:title,:author)";
	$q = $conn->prepare($sql);
	$q->execute(array(':author'=>$author,
	                  ':title'=>$title));		
}

?>

<?php

if (!empty($_POST['update'])) {
	// database connection
	$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);

	// new data
	$title = 'PHP Pattern';
	$author = 'Imanda';
	$id = 3;
	// query
	$sql = "UPDATE shops
	        SET title=?, author=?
			WHERE id=?";
	$q = $conn->prepare($sql);
	$q->execute(array($title,$author,$id));

}
?>
