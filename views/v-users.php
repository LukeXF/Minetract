<style type="text/css">
	a {
		color: #555;
	}
	.fa-stack {
		margin: -1px -3px;
	}
</style>
<section class="bg-1 widewrapper text-center not_timer">	
	<h1 class="not_timer">
		<span class="not_timer">
			<?php
				if (!empty($_GET)) {
					echo $_GET['users'] . " - Profile";
				} else {
					echo "Users";
				}
			?>
		</span>
	</h1>
</section>
<?php 
if (!empty($_GET)) {
?>
		<?php

			// Load the poosts 			
			$DB_HOST = DB_HOST;
			$DB_NAME = DB_NAME;

			if (!empty($_GET)) {
											
			    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", DB_USER, DB_PASS);
			    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = 'SELECT * FROM users
				    	WHERE user_name = :user_name';
				$sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth -> execute(
					array(':user_name' => $_GET['users'])
				);
				$user = $sth->fetchAll();

				// echo "<pre>";
				// print_r($user);
				// echo "</pre>";

			} else {



			}




		?>

		<div class="container">
			<div class="row news-nav">
				<div class="col-md-4">
				<?php 

					if ( $user[0]['user_name'] == $_SESSION['user_name'] ) {
						echo "<a href='" . $user[0]['user_name'] . "'>Edit your profile</a>";
					} else {
						echo "<a href='" . $_SESSION['user_name'] . "'>Go to your profile</a>";
					}
				?>

				</div>

				<div class="col-md-4">
					
					<a href="<?php echo $mt_url; ?>users/">Users Home</a>

				</div>

				<div class="col-md-4">
				<?php
				    if ($login->isUserLoggedIn() == true) {
				        echo "<a style='opacity:0.5' href='#conact#" . $_SESSION['user_name'] . "#comingsoon' data-placement='bottom' data-tooltip='tooltip' data-original-title='coming soon'>Contact User</a>";
				    } else {
				        echo "<a href='#conact' data-placement='bottom' title='' data-target='#login-popup' data-toggle='modal' data-tooltip='tooltip' data-original-title='click to login.'" . $_SESSION["user_name"] . "'#comingsoon'>Contact User</a>";
				    }
				?>
				</div>
			</div>
		</div>


		<div class="container">
			<div class="row">
				<?php $grav_url2 = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $user[0]['user_email'] ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size; ?>

				<div class="row change_settings">
				<div class="col-md-3">
					<div class="backing-grey" style="height: 309px; text-align:center;">
						<div class="row">
							<div class="col-xs-12">
								<img src="<?php echo $grav_url2; ?>" alt="..." class="img-circle img-profile" width="120px">
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12">	
								<h3 class="settings">
									<?php 

									if ( !empty($user[0]['user_name_first']) && !empty($user[0]['user_name_last']) ) {
										echo $user[0]['user_name_first'] . " " . $user[0]['user_name_last'];
									} else {
										echo $user[0]['user_name_first'] . $user[0]['user_name_last'];
									}
									?>
								</h3>
								<p><?php echo $user[0]['user_main_type']; ?></p>
								<span class="rating">
									<?php
										$i = $userStars;
										while ( $i > 0) {
											echo "<span class='star star-inverse'><i class='fa fa-star fa-lg'></i></span>";
											$i--;
										}
										$i = (5 - $userStars);
										while ( $i > 0) {
											echo "<span class='star star-inverse'><i class='fa fa-star-o fa-lg'></i></span>";
											$i--;
										}
									?>
								</span>
							</div>
						</div>
					</div>


					<div class="top-title">Statistics</div>
					<div class="backing-grey" style="text-align:center;">
						<div class="row">
							<div class="col-xs-12">	

								<p>
									<?php 
										
										echo "<br>";

										$d1 = new DateTime($user[0]['user_registration_datetime']);
										$d2 = new DateTime();
										$d3 = $d1->diff($d2);
										$months = ($d3->y*12)+$d3->m;

										if ($months == 0) {
											echo "New this month";
										} else {
											echo "Member for " . $months . " months.";
										}

									?>
								</p>
								<p>Developer</p>
							</div>
						</div>
					</div>



					<div class="top-title">Social</div>
					<div class="backing-grey backing-thin" style="text-align:center;">
						<div class="row">
							<div class="col-xs-12">	
					            <?php
					            	if (!empty($user[0]['user_social_twitter'])) {
					            		echo "
											<a href='" . $user[0]['user_social_twitter'] . "' target='_blank'>
												<span class='fa-stack fa-lg fa-dark'>
													<i class='fa fa-square fa-stack-2x'></i><i class='fa fa-twitter fa-stack-1x fa-inverse'></i>
												</span>
											</a>
					            		";
					            	}
					            	if (!empty($user[0]['user_social_github'])) {
					            		echo "
											<a href='" . $user[0]['user_social_github'] . "' target='_blank'>
												<span class='fa-stack fa-lg fa-dark'>
													<i class='fa fa-square fa-stack-2x'></i><i class='fa fa-github fa-stack-1x fa-inverse'></i>
												</span>
											</a>
					            		";
					            	}
					            	if (!empty($user[0]['user_social_behance'])) {
					            		echo "
											<a href='" . $user[0]['user_social_behance'] . "' target='_blank'>
												<span class='fa-stack fa-lg fa-dark'>
													<i class='fa fa-square fa-stack-2x'></i><i class='fa fa-behance fa-stack-1x fa-inverse'></i>
												</span>
											</a>
					            		";
					            	}
					            	if (!empty($user[0]['user_social_instagram'])) {
					            		echo "
											<a href='" . $user[0]['user_social_instagram'] . "' target='_blank'>
												<span class='fa-stack fa-lg fa-dark'>
													<i class='fa fa-square fa-stack-2x'></i><i class='fa fa-instagram fa-stack-1x fa-inverse'></i>
												</span>
											</a>
					            		";
					            	}
					            	if (!empty($user[0]['user_social_stackoverflow'])) {
					            		echo "
											<a href='" . $user[0]['user_social_stackoverflow'] . "' target='_blank'>
												<span class='fa-stack fa-lg fa-dark'>
													<i class='fa fa-square fa-stack-2x'></i><i class='fa fa-stack-overflow fa-stack-1x fa-inverse'></i>
												</span>
											</a>
					            		";
					            	}
					            	if (!empty($user[0]['user_social_website'])) {
					            		echo "
											<a href='" . $user[0]['user_social_website'] . "' target='_blank'>
												<span class='fa-stack fa-lg fa-dark'>
													<i class='fa fa-square fa-stack-2x'></i><i class='fa fa-globe fa-stack-1x fa-inverse'></i>
												</span>
											</a>
					            		";
					            	}
					            ?>
								
						

							</div>
						</div>
					</div>



					<div class="top-title">Contact Me</div>
					<div class="backing-grey backing-thin" style="text-align:center;">
						<div class="row">
							<div class="col-xs-12" style="color:#444;">	
								<?php /*
									if ($login->isUserLoggedIn() == false) {
										echo "<a href='login' style='color:#444;'>Sign In</a> to contact this person.";
									} else {
										echo "Click to email <a href='mailto:" . $user[0]['user_email'] . "'>" . $user[0]['user_email'] . "</a>";
									} */
								?>
								Coming Soon
							</div>
						</div>
					</div>
					
					<hr>

				</div>

				<div class="col-md-9">
					<div class="top-title">
						<?php 
							if (!empty($user[0]['user_desc_title'])) {
								echo $user[0]['user_desc_title'];
							} else {
								echo $user[0]['user_name'] . "'s Profile";
							}
						?>
					</div>
					<div class="backing-grey" style="height: 268px;">
						<p>
							
						<?php 
							if (!empty($user[0]['user_desc'])) {
								echo "<p>" . $user[0]['user_desc'] . "</p>";
							} else {
								echo  "<p style='opacity:0.5'>" . $user[0]['user_name'] . "'s Profile is empty :(</p>";
							}
						?>
						</p>
					</div>
				</div>

				<div class="col-md-9">
					<div class="row" style="margin-top:-10px;">


						<div class="col-md-4">
							<div class="top-title">My Developer Store</div>
							<div class="backing-grey backing-thin" style="text-align:center;">
								<div class="row" style="color:#444;">
									<div class="shop-mod shop-mod-overview">
									    <div class="shop-pricing">
											$<b>20</b>
											<br><h5>per hour</h5>
										</div>
									    <div class="shop-pricing">
											<b>0</b>
											<br><h5>projects</h5>
										</div>
									    <div class="shop-pricing">
											<b>0</b>
											<br><h5>views</h5>
										</div>
									    <div class="shop-pricing">
											<b>0</b>
											<br><h5>comments</h5>
										</div>
									    <div class="shop-keywords">
									    	<h5>PHP - HTML - CSS - JS
									    	</h5>
									    </div>
									</div>		

									<form action="process.php" method="post">
										<input class="btn btn-blue" type="submit" name="create-developer" value="View your Store">
									</form>
								</div>
							</div>
						</div>

						<div class="col-md-4" style="opacity:0.5">
							<div class="top-title">My Builder Store</div>
							<div class="backing-grey backing-thin" style="text-align:center;">
								<div class="row">
									<div class="col-xs-12" style="color:#444;">	
										-
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-4" style="opacity:0.5">
							<div class="top-title">My Artist Store</div>
							<div class="backing-grey backing-thin" style="text-align:center;">
								<div class="row">
									<div class="col-xs-12" style="color:#444;">	
										-
									</div>
								</div>
							</div>
						</div>

					</div>

					<hr>
				</div>


				<!--<div class="col-md-8">
					<?php /*

						echo "<pre>";
						echo "<h1>Stats I am stalking " . $_GET['id'] . " with:</h1>";
						print_r($user);
						echo "</pre>";
						echo "Your IP: " . $_SERVER['REMOTE_ADDR'];

					*/ ?>
				</div>-->

			</div>
		</div>

<?php
} else {

?>
		
	<!DOCTYPE HTML>
	<html lang="en-US">
	    <head>
	        <meta charset="UTF-8">
	        <meta http-equiv="refresh" content="1;url=<?php echo $mt_url . 'user-search'; ?>">
	        <script type="text/javascript">
	            window.location.href = "<?php echo $mt_url . 'user-search'; ?>"
	        </script>
	    </head>
	    <body>
	        <!-- Note: don't tell people to `click` the link, just tell them that it is a link. -->
	        If you are not redirected automatically, follow the <a href='<?php echo $mt_url . 'user-search'; ?>'>link</a>.
	    </body>
	</html>

<?php
}
?>