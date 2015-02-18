<?php
	$db_host = DB_HOST;
	$db_name = DB_NAME;


	$nametosearch = $_GET['id'];

	$conn = new PDO("mysql:host=$db_host;dbname=$db_name", DB_USER, DB_PASS);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$query = $conn->prepare("SELECT * from `users` WHERE `user_name` = :name");
	$query->bindParam(':name', $nametosearch);
	$query->execute();
	$user = $query->fetchAll();

?>

<section class="bg-1 widewrapper text-center small-wrap">	
	<h1 class="not_timer">
		<span class="not_timer">
			DiamondXF - Profile
		</span>
	</h1>
</section>

<?php

function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE) {
    $output = NULL;
    if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
        $ip = $_SERVER["REMOTE_ADDR"];
        if ($deep_detect) {
            if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
    }
    $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
    $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
    $continents = array(
        "AF" => "Africa",
        "AN" => "Antarctica",
        "AS" => "Asia",
        "EU" => "Europe",
        "OC" => "Australia (Oceania)",
        "NA" => "North America",
        "SA" => "South America"
    );
    if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
        $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
        if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
            switch ($purpose) {
                case "location":
                    $output = array(
                        "city"           => @$ipdat->geoplugin_city,
                        "state"          => @$ipdat->geoplugin_regionName,
                        "country"        => @$ipdat->geoplugin_countryName,
                        "country_code"   => @$ipdat->geoplugin_countryCode,
                        "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                        "continent_code" => @$ipdat->geoplugin_continentCode
                    );
                    break;
                case "address":
                    $address = array($ipdat->geoplugin_countryName);
                    if (@strlen($ipdat->geoplugin_regionName) >= 1)
                        $address[] = $ipdat->geoplugin_regionName;
                    if (@strlen($ipdat->geoplugin_city) >= 1)
                        $address[] = $ipdat->geoplugin_city;
                    $output = implode(", ", array_reverse($address));
                    break;
                case "city":
                    $output = @$ipdat->geoplugin_city;
                    break;
                case "state":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "region":
                    $output = @$ipdat->geoplugin_regionName;
                    break;
                case "country":
                    $output = @$ipdat->geoplugin_countryName;
                    break;
                case "countrycode":
                    $output = @$ipdat->geoplugin_countryCode;
                    break;
            }
        }
    }
    return $output;
}

?>


<div class="container" style="margin-top:50px;">
	<div class="row">
		<?php

			if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
					$_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
			}	
			echo "<pre>";
			echo "<h3>Stats I am stalking you with:</h3>";
				print_r($user);
			echo "</pre>";

		?>
		<?php $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $user[0]['user_email'] ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size; ?>

		<div class="row change_settings">
		<div class="col-md-3">
			<div class="backing-grey" style="height: 309px; text-align:center;">
				<div class="row">
					<div class="col-xs-12">
						<img src="<?php echo $grav_url; ?>" alt="..." class="img-circle img-profile" width="120px">
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">	
						<h3 class="settings"><?php echo $user[0]['user_first']; ?> <?php echo $user[0]['user_last']; ?></h3>
						<p>Developer</p>
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


			<div class="top-title">Statstics</div>
			<div class="backing-grey" style="text-align:center;">
				<div class="row">
					<div class="col-xs-12">	

						<p>
							<?php 

								$date1 = new DateTime($user[0]['user_date_joined']);
								$date2 = new DateTime();

								$interval = date_diff($date1, $date2);
								$difference = $interval->m + ($interval->y * 12);
								echo  "Member for " . $difference . ' months';

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
						<a href="http://twitter.com/DiamondXF" target="_blank">
							<span class="fa-stack fa-lg fa-dark">
								<i class="fa fa-square fa-stack-2x"></i><i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
							</span>
						</a>
						<a href="http://github.com/LukeXF" target="_blank">
							<span class="fa-stack fa-lg fa-dark">
								<i class="fa fa-square fa-stack-2x"></i><i class="fa fa-github fa-stack-1x fa-inverse"></i>
							</span>
						</a>
						<a href="https://www.behance.net/me37ae" target="_blank">
							<span class="fa-stack fa-lg fa-dark">
								<i class="fa fa-square fa-stack-2x"></i><i class="fa fa-behance fa-stack-1x fa-inverse"></i>
							</span>
						</a>
						<a href="http://stackoverflow.com/users/3554127/lukexf" target="_blank">
							<span class="fa-stack fa-lg fa-dark">
								<i class="fa fa-square fa-stack-2x"></i><i class="fa fa-stack-overflow fa-stack-1x fa-inverse"></i>
							</span>
						</a>

					</div>
				</div>
			</div>



			<div class="top-title">Email</div>
			<div class="backing-grey backing-thin" style="text-align:center;">
				<div class="row">
					<div class="col-xs-12" style="color:#444;">	
						<a href="login" style="color:#444;"s>Sign In</a> to contact this person.
					</div>
				</div>
			</div>
			
			<hr>

		</div>

		<div class="col-md-9">
			<div class="backing-grey" style="height: 309px;">
				<h3 class="settings"><?php echo $user[0]['user_details_title']; ?></h3>
				<p>
					<?php echo $user[0]['user_details']; ?>	
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