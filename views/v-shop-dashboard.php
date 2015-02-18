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
			$query = $conn->prepare("SELECT * FROM `shop` WHERE `shop_user` = '" . $_SESSION['user_id'] . "'");
			$query->execute();
			$shops = $query->fetchAll();
			$conn = null;

			$conn = new PDO("mysql:host=$db_host;dbname=$db_name", DB_USER, DB_PASS);
    		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query = $conn->prepare("SELECT * FROM `shop_keywords`");
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
				print_r($_POST);
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
			<p style="font-size:20px;">The current active shops are highlighed below. You may edit your store or view it publically <br>To open a new store simply click on the faded out shop. (coming in beta release)<br><br>
			</p>
		</div>

		<div class="row">
			<?php
				// Generate the default shops
				$notShop = array('developer', 'builder', 'artist');


				if (count($shops) == 0) {
					echo "
					<style>
						input.btn.btn-blue {
							display: -webkit-inline-box;
							font-size: 25px;
							border-radius: 7px;
						}
					</style>
					<div class='col-md-4'>
						<div class='shop-dash' style='opacity:1;'>
							<form action='shop-dashboard.php' method='post'>
							<button type='button' class='btn btn-blue' data-toggle='modal' data-target='#open-store'>
							 	Create your store
							</button>
							<h1 class='shop-title'><br>Click to open your first store</h1>
						</div>
					</div>

					<div class='modal fade' id='open-store'>
						<div class='modal-dialog'>
							<form method='post' action='shop-dashboard' name='loginform'>
								<div class='modal-content'>

									<div class='modal-header'>
										<h4 class='modal-title' id='open-store'>CREATE STORE</h4>
									</div>
									<div class='modal-body'>								
										<input type='email' id='shop_type' placeholder='email address' name='user_name'>
										<div class='styled-select'> <select><option>Here is the first option</option><option>The second option</option></select></div>
										<textarea type='password' id='shop_desc' placeholder='password' name='user_password'></textarea>
									</div>
									<div class='modal-footer'>
										<button type='submit' value='Login' name='login' class='btn btn-primary'>Sign In</button>
										
									    <input type='checkbox' id='user_rememberme' name='user_rememberme' value='1'>
									    <label class='save' for='user_rememberme'>Keep me logged in</label><br>
										<div><a href='forgot'>forgotten details?</a></div>
										<div><a href='register'>sign up</a></div>
									</div>

								</div>
							</form>
						</div>
					</div>

					";
				} else {


					///////////////////////////////////////////////////
					// Generate the shops that the user has created
					$i = 0;
					while ($i < 1) {
						// Display the current shops in use
						echo "
						<div class='col-md-4'>
							<div class='shop-dash'>
								<div class='shop-buttons'>
									<div class='col-xs-6'>
										<form action='shop-dashboard.php' method='post'>
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
										<b>" . $shops[$i]['shop_likes'] . "</b>
										<br><h5>shop likes</h5>
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
										$query = $conn->prepare("SELECT * FROM `shop_keywords` WHERE `keywords_shop` = '" . $shops[$i]['shop_id'] . "'");

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
				}






				// Creates the shops that are not in use
				$count = count($notShop);
				$notShop = array_values($notShop);





				// Generate the empty shops
				/* $i = 0;
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
				} */
			?>
			<div class="col-md-4">
				<div class="shop-dash" style="opacity:0.5;">
					<form action="process.php" method="post">
					</form> <h1 class="shop-title"><br>Shop Two<br>Coming in<br>Beta<br>Release</h1>
				</div>
			</div>
			<div class="col-md-4">
				<div class="shop-dash" style="opacity:0.5;">
					<form action="process.php" method="post">
					</form> <h1 class="shop-title"><br>Shop Three<br>Coming in<br>Beta<br>Release</h1>
				</div>
			</div>
		</div>


	</div>
</div>

