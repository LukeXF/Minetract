<section class="bg-1 widewrapper text-center small-wrap">	
	<h1 class="not_timer">
		<span class="not_timer">
			Shop Management
		</span>
	</h1>
</section>

<div class="container" style="margin-top:50px;">
	<div class="row">

		<?php
			$db_host = DB_HOST;
			$db_name = DB_NAME;
			$conn = new PDO("mysql:host=$db_host;dbname=$db_name", DB_USER, DB_PASS);
    		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query = $conn->prepare("SELECT * FROM `shops` WHERE `shop_owner` = '" . $user['id'] . "'");
			$query->execute();
			$shops = $query->fetchAll();
			$conn = null;

			$conn = new PDO("mysql:host=$db_host;dbname=$db_name", DB_USER, DB_PASS);
    		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query = $conn->prepare("SELECT * FROM `keywords`");
			$query->execute();
			$keywords = $query->fetchAll();
			$conn = null;

			// Display all the shops the user owns and their information
			if ($debug) {
				echo "<div class='col-md-4'><pre>
				<b><br>Displaying shop data related to your user</b>:<br>";
				print_r($shops);
				echo "</pre></div>";
				echo "<div class='col-md-4'><pre>
				<b><br>Displaying the keywords for each store</b>:<br>";
				print_r($keywords);
				echo "</pre></div>";
				echo "<div class='col-md-4'><pre>
				<b><br>Session Data</b>:<br>";
				print_r($_SESSION);
				echo "</pre></div>";
				echo "<div class='col-md-4'><pre>
				<b><br>User's Account Type</b>:<br>";
				print_r($accountType);
				echo "</pre></div>";

			}

		?>

		<div class="col-md-12">
			<p style="font-size:20px;">Hello <?php echo $_SESSION['user_name']; ?>, You currently have <?php echo count($shops); ?> out of the available <?php echo $accountType['shops']; ?> shops for your account.</p>
			<p style="font-size:20px;">The current active shops are highlighed below. To open a new store simply click on the faded out shop.<br><br>
			</p>
		</div>

		<div class="row">
			<?php
				// Generate the default shops
				$notShop = array('developer', 'builder', 'artist');






				///////////////////////////////////////////////////
				// Generate the shops that the user has created
				$i = 0;
				while ($i < 2) {
					// Display the current shops in use
					echo "
					<div class='col-md-4'>
						<div class='shop-dash'>
							<div class='shop-buttons'>
								<div class='col-xs-6'>
									<form action='process.php' method='post'>
										<input class='btn btn-blue' type='submit' name='create-" . $shops[$i]['shop_type'] . "' value='View your Store'>
									</form>
								</div>
								<div class='col-xs-6'>
									<form action='process.php' method='post'>
										<input class='btn btn-danger' type='submit' name='create-" . $shops[$i]['shop_type'] . "' value='Edit your Store'>
									</form>
								</div>
							</div>
							<h1 class='shop-title'>" . $shops[$i]['shop_type'] . "<br>Shop</h1>" . "
							<div class='shop-mod'>
							    <div class='shop-pricing'>
									$<b>" . $shops[$i]['shop_price'] . "</b>
									<br><h5>per hour</h5>
								</div>
							    <div class='shop-pricing'>
									<b>0</b>
									<br><h5>projects</h5>
								</div>
							    <div class='shop-pricing'>
									<b>0</b>
									<br><h5>page views</h5>
								</div>
							    <div class='shop-pricing'>
									<b>0</b>
									<br><h5>comments</h5>
								</div>
							    <div class='shop-keywords'>
							    	<h5>";


				
									///////////////////////////////////////////////////
									// Connect to database to load keywords.
									$conn = new PDO("mysql:host=$db_host;dbname=$db_name", DB_USER, DB_PASS);
						    		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
									$query = $conn->prepare("SELECT * FROM `keywords` WHERE `keywords_shop` = '" . $shops[$i]['shop_id'] . "'");

									$query->execute();
									// Set variable to the full array
									$keywords = $query->fetchAll();
									// Close connection
									$conn = null;





									// set the keyword itteration varible
									$keyi = 0;
									// If the the owner of the shop has any keywords displa them
									if (!empty($keywords[$keyi]['keywords_value'])) {
										// loop through and repeat all the keywords
										$keywordscount = count($keywords);
										// echo out all of the keywords
										while ( $keyi < $keywordscount )  {					
											echo $keywords[$keyi]['keywords_value'];

											// add in the commars to the keywords
											if ($keyi < ($keywordscount - 1) ) {
												echo " - ";
											}

											$keyi++;
										}
									} else {
										echo "-";
									}





							    		echo "
							    	</h5>
							    </div>
							</div>
						</div>
					</div>";

						
					// To generate the shops that the user has not been created.
					if (in_array($shops[$i]['shop_type'] , $notShop)){
				   		unset($notShop[array_search($shops[$i]['shop_type'] ,$notShop)]);
					}
									
					$i++;
				}






				// Creates the shops that are not in use
				$count = count($notShop);
				$notShop = array_values($notShop);





				// Generate the empty shops
				$i = 0;
				while ($i < $count) {
					echo "
					<div class='col-md-4'>
						<div class='shop-dash' style='opacity:0.5;'>
							<form action='process.php' method='post'>
								<input class='btn btn-blue' type='submit' name='create-" . $shops[$i]['shop_type'] . "' value='Open Store'>
							</form> " .
						"<h1 class='shop-title'>" . $notShop[$i] . "<br>Shop</h1>" . "
						</div>
					</div>";
					$i++;
				}
			?>
		</div>

		<div class="col-md-8">

			<form action="process.php" method="post">
			  First name: <input type="text" name="fname"><br>
			  Last name: <input type="text"  name="lname"><br>
			  <input type="submit" value="Submit">
			</form>


		</div>

	</div>
</div>

