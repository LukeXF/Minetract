<style type="text/css">
	a {
		color: #555;
	}
	.fa-stack {
		margin: -1px -3px;
	}
</style>
<section class="bg-1 widewrapper text-center search">	
	<p class="lead">freelancers user search</p>

	<form action="user-search.php" method="get">
		<span><input type="text" name="search" class="search rounded" placeholder="Search..."></span>
		<button type="submit" value="submit" class="btn btn-minetract btn-lg">Search</button>
	</form>
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
				$sql = 'SELECT `user_name`, `user_name_first`, `user_name_last`, `user_email`, `user_main_type` FROM users
				    	WHERE user_name LIKE :user_name OR user_name_first LIKE :user_name OR user_email LIKE :user_name OR user_name_last LIKE :user_name LIMIT 24';
				$sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

				$sth -> execute(
					array(':user_name' => '%'.$_GET['search'].'%')
				);
				$user = $sth->fetchAll();

				// echo "<pre>";
				// print_r($user);
				// echo "</pre>";

			}
		?>

		<div class="container">
			<div class="row news-nav">
				<div class="col-md-4">
				<?php 
					echo "<a href='" . $_SESSION['user_name'] . "'>Go to your profile</a>";
				?>

				</div>

				<div class="col-md-8">
					
					<a href="<?php echo $mt_url; ?>user-search?search=<?php echo $_GET['search']; ?>">Currently Searching For: <b><?php echo $_GET['search']; ?></b></a>

				</div>

			</div>
		</div>


		<div class="container">
			<div class="row">
				<div class='row change_settings'>

				<?php

					$i = 0;
					$count = count($user);
					while ($i < $count) {

						$grav_url2 = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $user[$i]['user_email'] ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
						echo "
						<a href='" . $mt_url . "user/" . $user[$i]['user_name'] . "'>
							<div class='col-md-3'>
								<div class='backing-grey' style='height: 309px; text-align:center;'>
									<div class='row'>
										<div class='col-xs-12'>
											<img src='" . $grav_url2 . "' alt='...' class='img-circle img-profile' width='120px'>
										</div>
									</div>
									<div class='row'>
										<div class='col-xs-12'>	
											<h3 class='settings'>
						";
											

												if ( !empty($user[$i]['user_name_first']) || !empty($user[$i]['user_name_last']) ) {
													echo $user[$i]['user_name_first'] . " " . $user[$i]['user_name_last'];
												} else {
													echo $user[$i]['user_name'];
												}
						echo "
											</h3>
											<p>" . $user[$i]['user_main_type'] . "</p>
											<span class='rating'>
						";
													$i2 = $userStars;
													while ( $i2 > 0) {
														echo "<span class='star star-inverse'><i class='fa fa-star fa-lg'></i></span>";
														$i2--;
													}
													$i2 = (5 - $userStars);
													while ( $i2 > 0) {
														echo "<span class='star star-inverse'><i class='fa fa-star-o fa-lg'></i></span>";
														$i2--;
													}
						echo "
											</span>
										</div>
									</div>
								</div>
							</div>
						</a>
						";

						$i++;
					}
				?>


			</div>
			<p>Showing a total of <?php echo $count; ?> out of <?php echo $count; ?> users.</p>
		</div>

<?php
} else {

?>
	
<?php
}
?>