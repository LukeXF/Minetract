<!-- Page Content -->
<div class="container" style="margin-top:30px;">

		<div class="row">

				<div class="col-md-3">
						<p class="lead">Gunsdaily Main Store</p>
							<?php 
								$categoryCounter = 0;

								$age=array("all","accessories","apparel","t-shirt");

								// While incrementing counter is less than the total amount of values inside array $age
								while($categoryCounter < count($age)) {
									// if URL get request matches exactly to any array value set it's box to active
									if ($_GET['product-type'] == $age[$categoryCounter]) {
										$categoryActive = " active";
									} else {
										$categoryActive = "";
									}
									// if the array value is all then set no URL path adding of product else add product to URL
									if ($age[$categoryCounter] == "all") {
										$categoryLink = "/shop/";
									} else  {
										$categoryLink = "/shop/" . $age[$categoryCounter];
									}
									// If any array value equals exactly "all" and no get request is made then assume they are on all products
									if ( ($age[$categoryCounter] == "all") && (!isset($_GET['product-type'])) ) {
										$categoryActive = " active";
									}
									/*
									// If they select an empty category display error message
									if ( ($_GET['product-type'] != $age[$categoryCounter]) && (isset($_GET['product-type'])) ) {
										$categoryEmpty = "<h3>You are trying to view a category that does not exist. Please try again.</h3>";
									} else {
										$categoryEmpty = "";
									}
									*/
									// Process all the magic into side navigational bar
									echo "<a href='" . $categoryLink . "' class='list-group-item" . $categoryActive . "'> " . $age[$categoryCounter] . "</a>";
									$categoryCounter++;
								}
							?>
				</div>

				<div class="col-md-9">
						<div class="row">

							<?php
								$userdb = DB_USER;
								$passdb = DB_PASS;
								$hostdb = DB_HOST;
								$namedb = DB_NAME;

								function limit_desc($text, $limit) {
									if (str_word_count($text, 0) > $limit) {
											$words = str_word_count($text, 2);
											$pos = array_keys($words);
											$text = substr($text, 0, $pos[$limit]) . '...';
									}
									return $text;
								}
								// This is for changing categories of product and applies the final result from the if statement to the SQL query
								if ( isset($_GET['product-type']) ) {
									$productType =  " WHERE store_tag = '" . $_GET['product-type'] . "'";
								} else {
									$productType = "";
								}

								try {
									// Connect and create the PDO object
									$conn = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
									$conn->exec("SET CHARACTER SET utf8");      // Sets encoding UTF-8

									// Define and perform the SQL SELECT query
									$sql = "SELECT * FROM `store` $productType";
									$result = $conn->query($sql);

									// Parse returned data, and displays them
									while($row = $result->fetch(PDO::FETCH_ASSOC)) {
										echo "<div class='col-sm-4 col-lg-4 col-md-4'>";
										echo "	<div class='thumbnail'>";
										echo "		<img src='/assets/img/store/" . $row['store_id'] . ".png' style='height:150px; width:320px;' alt='Image not found'>";
										echo "		<div class='caption'>";
										echo "			<h4 class='pull-right'>$" . $row['store_price'] . "</h4>";
										echo "			<h4><a href='#'>" . limit_desc($row['store_name'], 3) . "</a>";
										echo "			</h4>";
										echo "			<p>" . limit_desc($row['store_desc'], 20) . "</p>";
										echo "		</div>";
										echo "		<div class='ratings'>";
										echo "			<p class='pull-right'>" . count($sqlIntoArray["STORE PRODUCT NUMBER " . $row['store_id']]) . " reviews</p>";
										echo "			<p>";

										// Creates the stars, ceil rounds up decimal				
										$starsCounter = 1;
										while($starsCounter <= ceil($finalAverageRating["Product " . $row['store_id']])) {
											echo "<span class='fa fa-star'></span>";
											$starsCounter++;
										}
										//	while($starsCounter <= 5) {
										//		echo "<span class='fa fa-star'></span>";
										//		$starsCounter++;
										//	}
										// Calulates the amount of stars that have not been applied
										$emptyStars = 5 - ($starsCounter - 1);

										$i = 0;
										$times_to_run = 16;
										$array = array();
										while ($i++ < $emptyStars)
										{
										    echo "<span class='fa fa-star-o'></span>";
										}
										//for ($starsCounter<=5; $starsCounter++;) {
										//   echo "The number is: $starsCounter <br>";
										//}
										echo "			</p>";
										echo "		</div>";
										echo "	</div>";
										echo "</div>";
									}

									$conn = null;        // Disconnect
								}
								catch(PDOException $e) {
									echo $e->getMessage();
								}

								// If they select an empty category display error message
								echo $categoryEmpty;
							?>
							<div class="col-sm-4 col-lg-4 col-md-4">
									<h4><a href="#">Have a suggestion for us?</a>
									</h4>
									<p>We are always looking to offer the best range of apparel and merchandise. Do you have a great idea for us? Tell us and get a discount if it goes live!</p>
									<a class="form-button green small" style="float:left !important" target="_blank" href="">Submit Suggestion</a>
							</div>

						</div>

				</div>
		</div>

</div>