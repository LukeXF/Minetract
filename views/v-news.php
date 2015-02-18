<section class="bg-1 widewrapper text-center not_timer">	
	<h1 class="not_timer">
		<span class="not_timer">
			News Feed
		</span>
	</h1>
</section>


<div class="container">
	<div class="main">
		<?php

			// Load the poosts 			
			$DB_HOST = DB_HOST;
			$DB_NAME = DB_NAME;

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


			function loadNext($post) {
				try{
					// Load the poosts 			
					$DB_HOST = DB_HOST;
					$DB_NAME = DB_NAME;
				    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", DB_USER, DB_PASS);
				    // Communication
				    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				    $stmt = $dbh->prepare("SELECT `news_title` FROM news where `news_id` = '" . $post . "'");
				    $stmt->execute();
				    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
				    $dbh = null;

				} catch(PDOException $e) { 
					echo $e->getMessage(); 
				}

				return "?post=" . toDashes($result[0]['news_title']);
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

			if (!empty($_GET)) {
				


				///////////////////////////////////////////////////////////////////////////////////////////////////////////////
				// SINGLE POST

				$title = toSpaces($_GET['post']);

				try{
				    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", DB_USER, DB_PASS);
				    // Communication
				    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				    $stmt = $dbh->prepare("SELECT * FROM news where `news_title` = '" . $title . "'");
				    $stmt->execute();
				    $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
				    $dbh = null;

				} catch(PDOException $e) { 
					echo $e->getMessage(); 
				}


				// echo "<pre>";
				// print_r($result);
				// echo "</pre>";

				// Load the nav for news

			    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", DB_USER, DB_PASS);
			    // Communication
			    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql="SELECT count(*) FROM `news`";
				$sth = $dbh->prepare($sql);
				$sth->execute(array($key));
				$rows = $sth->fetch(PDO::FETCH_NUM);
				$totalnews = $rows[0];

				echo "
					<div class='container'>
						<div class='row news-nav'>
							<div class='col-md-4'>
				";	
							if ($result[0]['news_id'] > 1) {
								echo "<a class='animate' href='" . loadNext( ($result[0]['news_id']) -1 ) . "'>Previous Post</a>";
							}
								
				echo "
							</div>

							<div class='col-md-4'>
								<a class='animate' href='" . $mt_url . "news'>News home</a>
							</div>

							<div class='col-md-4'>
				";

								if ($totalnews != $result[0]['news_id']) {
									echo "<a class='animate' href='" . loadNext( ($result[0]['news_id']) +1 ) . "'>Next Post</a>";
								}
								
				echo "
							</div>
						</div>
					</div>
				";

				// loop through the posts
				$i = 0;
				$count = count($result);

				while ( $i < $count) {

					// load the user data of who posted each news post
					try{
					    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", DB_USER, DB_PASS);
					    // Communication
					    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					    $stmt = $dbh->prepare("SELECT `user_name`, `user_email` FROM users where `user_id` = " . $result[$i]['news_author']);
					    $stmt->execute();
					    $author=$stmt->fetchAll(PDO::FETCH_ASSOC);
					    $dbh = null;

					} catch(PDOException $e) { 
						echo $e->getMessage(); 
					}

					// Gratar picture of author
					$authorPic = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $author[0]['user_email'] ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

					// Debug of author
					// echo "<pre>";
					// print_r($author);
					// echo "</pre>";

					$d = strtotime($result[$i]['news_date']);
					// echo "Created date is " . date("dS M Y h:i:sa", $d);

					echo "
						<a href='?post=" . toDashes($result[$i]['news_title']) . "'>
							<div class='news-post animate'>
				 				<h3>" . $result[$i]['news_title'] . "</h3>
				 				<h5>" . date("h:ia - dS F", $d) . "</h5>
								". $result[$i]['news_content'] . "

								<hr>
								<a class='profile' href='" . $mt_url . "user/" . $author[0]['user_name'] . "'> 
									By&nbsp;&nbsp;<h4 class='animate'>
										<img src='" . $authorPic . "'>
										" . $author[0]['user_name'] . "
									</h4>
								</a>
							</div>
						</a>						
					";
					$i++;
				}


				////////////////////////////////////////////////////////////////////////////////////////////////////////////////
				// COMMENTS

				// load the user data of who posted each news post
				try{
					$dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", DB_USER, DB_PASS);
					// Communication
					$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					$stmt = $dbh->prepare("SELECT * FROM `news_comments` where `newsc_post` = '" . $result[0]['news_id'] . "'");
					$stmt->execute();
					$comments=$stmt->fetchAll(PDO::FETCH_ASSOC);
					$dbh = null;

				} catch(PDOException $e) { 
					echo $e->getMessage(); 
				}

				// echo "<pre>";
				// print_r($comments);
				// echo "</pre>";

				$count = count($comments);

				if ($count == 0) {
					echo "<!-- There are no comments -->";
				} else {
					$i = 0;

					echo "<h3 style='margin-top:50px;' class='animate title'>Comments</h3>";


					while ($i < $count) {
						
						// load the user data of who posted each news post
						try{
						    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", DB_USER, DB_PASS);
						    // Communication
						    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						    $stmt = $dbh->prepare("SELECT `user_name`, `user_email` FROM users where `user_id` = " . $comments[$i]['newsc_user']);
						    $stmt->execute();
						    $comments_author=$stmt->fetchAll(PDO::FETCH_ASSOC);
						    $dbh = null;

						} catch(PDOException $e) { 
							echo $e->getMessage(); 
						}

						// Gratar picture of author
						$authorPic = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $comments_author[0]['user_email'] ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;


						$d = strtotime($comments[$i]['newsc_date']);

						// If the post been curretnly outputted belongs to the user logged in
						if ($comments_author[0]['user_email'] == $_SESSION['user_email']) {
							$delete = "
								<div class='delete'>
									<form action='delete.php?post=" . $_GET['post'] . "' method='post'>
										<input class='animate delete' value='Delete' type='submit'>
										<input type='hidden' name='Language' value='" . $comments[$i]['newsc_user'] . "--" . $comments[$i]['newsc_date'] . "--" . $comments[$i]['newsc_post'] . "'>
										<input type='hidden' name='news_post' value='" . $comments[$i]['newsc_id'] . "'>
										<input type='hidden' name='news_comment_id' value='" . $comments[$i]['newsc_post'] . "'>
									</form>

								</div>";


						} else {
							$delete = "";
						}

						echo "
							<div class='news-post animate news_comments'>
								" . $delete . "
								<p>" . $comments[$i]['newsc_content'] . "</p>
								<hr>
								<a class='profile' href='" . $mt_url . "user/" . $comments_author[0]['user_name'] . "'> 
								<h5>" . date("h:ia - dS F", $d) . "</h5>
									By&nbsp;&nbsp;<h4 class='animate'>
										<img src='" . $authorPic . "'>
										" . $comments_author[0]['user_name'] . "
									</h4>
								</a>

							</div>
						";


						

						// echo "<pre>";
						// print_r($comments_author);
						// print_r($_SESSION);
						// echo "</pre>";

						$i++;
					}

				}
				// end of listing comments



				echo "
				<div class='news-post animate news_comments'>
					<h3 class='animate'>Your Comment</h3>
					<div class='row'>					
						<div class='col-md-6 col-md-offset-3'>
							<div class='row'>
								<div class='col-md-12'>

									<form action='?post=" . $_GET['post'] . "' method='post'>
										<textarea name='message' class='textbox' placeholder='Enter your message'></textarea>
										<input type='submit' class='animate submit'>
									</form>


									<a class='profile' href='" . $mt_url . "user/" . $_SESSION['user_name'] . "'> 
										Posting as &nbsp;<h4 class='animate'>
											<img src='" . $grav_url . "'>
											" . $_SESSION['user_name'] . "
										</h4>
									</a>


								</div>
							</div>
						</div>
					</div>
				</div>



				";

				if (!empty($_POST["message"])) {
					    

						
					    $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", DB_USER, DB_PASS);
					    // Communication
					    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

						$sql = "INSERT INTO news_comments(
				            newsc_content,
				            newsc_user,
				            newsc_post
				            ) VALUES (
				            :newsc_content, 
				            :newsc_user,
				            :newsc_post)";

						$stmt = $dbh->prepare($sql);
						                                              
						$stmt->bindParam(':newsc_content', $_POST["message"], PDO::PARAM_STR);       
						$stmt->bindParam(':newsc_user', $_SESSION['user_id'], PDO::PARAM_STR); 
						$stmt->bindParam(':newsc_post', $result[0]['news_id'], PDO::PARAM_STR);   
						                                      
						$stmt->execute(); 
					}






			} else {








				///////////////////////////////////////////////////////////////////////////////////////////////////////////////
				// ALL POSTS


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

					echo "
						<a href='?post=" . toDashes($result[$i]['news_title']) . "'>
							<div class='news-post animate'>
				 				<h3>" . $result[$i]['news_title'] . "</h3>
				 				<h5>" . date("h:ia - dS F", $d) . "</h5>
								". $result[$i]['news_content'] . "

								<hr>
								<a class='profile' href='" . $mt_url . "user/" . getUsername($result[$i]['news_author']) . "'> 
									By&nbsp;&nbsp;<h4 class='animate'>
										<img src='" . $authorPic . "'>
										" . getUsername($result[$i]['news_author']) . "
									</h4>
								</a>
					";

					$i2 = 0;
					$count2 = count($comments);

					// to force only to display 3 latests commenters 
					if ($count2 > 3) {
						$count2 = 3;
					}

					while ( $i2 < $count2) {


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

					}

					echo "

							</div>
						</a>
					
					";

					$i++;
				}

			}






		?>



	</div>
</div>