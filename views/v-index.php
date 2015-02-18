<style type="text/css">
	.news-post {
		padding-top: 10px;
	}
	.tooltip-inner {
	padding: 10px;
	font-size: 12px;
	width: initial !important;
	text-align: center;
}
	</style>
<?php

	// Count all the users inside our users table
	require('classes/CountUsersFunction.php');
	$field = 'user_id';
	$condition = "";
	$DB_Table = 'users';
	$fieldArray = fieldCount($field, $condition, $DB_Table);
	$i=0;
	while( $i < count ($fieldArray) )
	{
	    $totalCount = $totalCount + $fieldArray[$i]['count'];
	    $i++;
	}

	function toDashes($text) { 
	    $text = strtolower(htmlentities($text)); 
	    $text = str_replace(get_html_translation_table(), " ", $text);
	    $text = str_replace(" ", "-", $text);
	   	return $text;
	}

	function toSpaces($string) {
		$string = str_replace("-", " ", $string);
		return $string;
	}

	function limitString($string, $limit = 100) {
	    // Return early if the string is already shorter than the limit
	    if(strlen($string) < $limit) {return $string;}

	    $regex = "/(.{1,$limit})\b/";
	    preg_match($regex, $string, $matches);
	    return $matches[1];
	}

	function getUsername($swag) {
		// get username
		// Load the poosts 			
		$DB_HOST = DB_HOST;
		$DB_NAME = DB_NAME;
		try{
		    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", DB_USER, DB_PASS);
		    // Communication
		    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $stmt = $dbh->prepare("SELECT `user_name` FROM users where `user_id` = '" . $swag . "'");
		    $stmt->execute();
		    $author=$stmt->fetchAll(PDO::FETCH_ASSOC);
		    $dbh = null;

		} catch(PDOException $e) { 
			echo $e->getMessage(); 
		}

		return $author[0]['user_name'];
	}

	function getEmail($swag) {
		// get username
		// Load the poosts 			
		$DB_HOST = DB_HOST;
		$DB_NAME = DB_NAME;
		try{
		    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", DB_USER, DB_PASS);
		    // Communication
		    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    $stmt = $dbh->prepare("SELECT `user_email` FROM users where `user_id` = '" . $swag . "'");
		    $stmt->execute();
		    $author=$stmt->fetchAll(PDO::FETCH_ASSOC);
		    $dbh = null;

		} catch(PDOException $e) { 
			echo $e->getMessage(); 
		}

		return $author[0]['user_email'];
	}

	function objectToArray($d) {
		if (is_object($d)) {
			$d = get_object_vars($d);
		}
		if (is_array($d)) {
			return array_map(__FUNCTION__, $d);
		}
		else {
			return $d;
		}
	}

?>	


<section class="bg-1 widewrapper text-center">
		<?php 
			// show potential errors / feedback (from login object)
				    if ($login->errors) {
				        foreach ($login->errors as $error) {
				            echo $error;
				        }
				    } elseif ($login->messages) {
				        foreach ($login->messages as $message) {
				            echo $message;
				        }
				    } else {
						echo "
							<h1><span class='timer'>" . $totalCount . "</span></h1>
							<p class='lead'>freelancers that are ready for you.</p>";
					}
		?>
	<button type="button" class="btn btn-minetract btn-lg">About</button>
	<button type="button" class="btn btn-minetract btn-lg">Marketplace</button>
</section>

<div class="container">
	<div class="main">
		<section>
			<h3>Featured</h3>
			<p class="lead">just for you</p>
		</section>
		<div class="row featured">
			<div class="col-md-3 col-xs-6"><div class="inner-featured"></div></div>
			<div class="col-md-3 col-xs-6"><div class="inner-featured"></div></div>
			<div class="col-md-3 col-xs-6"><div class="inner-featured"></div></div>
			<div class="col-md-3 col-xs-6"><div class="inner-featured"></div></div>
		</div>
	</div>
</div>

<div class="grey">
	<div class="container">
		<div class="row grey-featured featured news-twitter">
			<div class="col-md-6">				
				<h3>Recent Changes</h3>

				<p class="lead">view all</p>
				<div class="row">
					
					<?php 
						// Load the poosts 			
						$DB_HOST = DB_HOST;
						$DB_NAME = DB_NAME;
						try{
						    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", DB_USER, DB_PASS);
						    // Communication
						    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						    $stmt = $dbh->prepare("SELECT * FROM news");
						    $stmt->execute();
						    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
						    $dbh = null;

						} catch(PDOException $e) { 
							echo $e->getMessage(); 
						}


						// echo "<pre>";
						// print_r($result);
						// echo "</pre>";

						// loop through the posts
						$i = 0;
						$count = count($result);

						while ( $i < $count) {


							////////////////////////////////////////////////////////////////////////////////////////////////////////////////
							// COMMENTS

							// load the user data of who posted each news post
							try{
								$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", DB_USER, DB_PASS);
								// Communication
								$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
								$stmt = $dbh->prepare("SELECT * FROM `news_comments` where `newsc_post` = '" . $result[$i]['news_id'] . "'");
								$stmt->execute();
								$comments = array_reverse($comments=$stmt->fetchAll(PDO::FETCH_ASSOC));
								$dbh = null;

							} catch(PDOException $e) { 
								echo $e->getMessage(); 
							}

							// echo "<pre>";
							// print_r($comments);
							// echo "</pre>";

						



							////////////////////////////////////////////////////////////////////////////////////////////////////////////////
							// AUTHOR


							 
							// Gratar picture of author
							$authorPic = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( getEmail($result[$i]['news_author']) ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

							// Debug of author
							// echo "<pre>";
							// print_r($author);
							// echo "</pre>";
		 
							$d = strtotime($result[$i]['news_date']);
							// echo "Created date is " . date("dS M Y h:i:sa", $d);


							$count2 = count($comments);

							echo "
								<a href='news/?post=" . toDashes($result[$i]['news_title']) . "'>
									<div class='news-post animate'>
						 				<h3>" . $result[$i]['news_title'] . "</h3>
						 				<h5>" . date("h:ia - dS F", $d) . "</h5>
										<a class='profile' href='" . $mt_url . "user/" . getUsername($result[$i]['news_author']) . "'> 
											By&nbsp;&nbsp;<h4 class='animate'>
												<img src='" . $authorPic . "'>
												" . getUsername($result[$i]['news_author']) . "
											</h4>
										</a>

										$count2 comments
							";

							$i2 = 0;

							// to force only to display 3 latests commenters 
							if ($count2 > 3) {
								$count2 = 3;
							}

							/* while ( $i2 < $count2) {


								// Gratar picture of author
								$authorPic = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( getEmail($comments[$i2]['newsc_user']) ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

								if ($i2 == 0) {	
									// If there is only one comment then correct thr grammar
									if ($count2 == 1) {
										$oneComment = "Comment";
									} else {
										$oneComment = "Comments";
									}
									
									echo "
										<a style='margin-left: 60px;' class='profile' href='" . $mt_url . "user/" . getUsername($comments[$i2]['newsc_user']) . "'> 
											Latest " . $oneComment . " From &nbsp;&nbsp; <h4 class='animate'>
												<img src='" . $authorPic . "'>
												" . getUsername($comments[$i2]['newsc_user']) . "
											</h4>
										</a>
									";
								} else {
									echo "
										<a style='margin-left: 20px;' class='profile' href='" . $mt_url . "user/" . getUsername($comments[$i2]['newsc_user']) . "'> 
											<h4 class='animate'>
												<img src='" . $authorPic . "'>
												" . getUsername($comments[$i2]['newsc_user']) . "
											</h4>
										</a>
										";
								}
									$i2++;

							} */

							echo "

									</div>
								</a>
							
							";

							$i++;
						}


					?>

				</div>
				
			</div>
			<div class="col-md-6">
				<h3>Latest Tweets</h3>
				<p class="lead">@minetract</p>
				<div class="row">
					<?php include ('assets/twitter.php'); ?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="main">
		<div class="row">
			<div class="col-md-6">
				<section>
					<h3>Users Most Recently Registered</h3>
				</section>
			</div>
			<div class="col-md-6">
				<!--<section class="spacing">
					<h3><br></h3>
					<span class="lead">Builders</span>
					<span class="lead">Artists</span>
					<span class="lead">Programmers</span>
				</section>-->
			</div>
		</div>
		<div class="row featured">
			<?php 
						// Load the poosts 			
						$DB_HOST = DB_HOST;
						$DB_NAME = DB_NAME;
						try{
						    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", DB_USER, DB_PASS);
						    // Communication
						    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						    $stmt = $dbh->prepare("SELECT * FROM users LIMIT 22");
						    $stmt->execute();
						    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
						    $dbh = null;

						} catch(PDOException $e) { 
							echo $e->getMessage(); 
						}


						// echo "<pre>";
						// print_r($result);
						// echo "</pre>";

						// loop through the posts
						$i = 0;
						$count = count($result);


						while ( $i < $count) {


							// Gratar picture of author
							$authorPic = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $result[$i]['user_email'] ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;


							echo "

							<a class='profile ' href='http://dev.minetract.net/user/" . $result[$i]['user_name'] . "'> 
								<div 
									class='recently_registered' 
									data-placement='bottom' title='' 
									data-tooltip='tooltip' 
									data-original-title='" . $result[$i]['user_name'] . "' 
									style='background: url(" . $authorPic . ") #09C6E8'
								>

								</div>
							</a>
			

							";

							$i++;
						}


					?>
	

		</div>
	</div>
</div>
