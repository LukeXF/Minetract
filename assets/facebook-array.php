
<?php
	// Sets the title of the page for human use
	echo "<title>" . "SOCIAL ARRAY" . "</title>";

	// Turn on debugging
	// ini_set('display_errors', 1);
?>



<?php // FACEBOOK STATS

	// Loads the FaceBook SDK system for PHP
	require '/var/www/html/luke/demo.luke.sx/gunsdaily.net/assets/external/facebook.php';

	// Create our Application instance that allows connecting to FaceBook.
	$facebook = new Facebook(array(
		'appId' => '766850110025533',
		'secret' => 'a749e5886359fb172cf45402ba4c8514',
	));

	// This call will always work since we are fetching public data.
	$user_profile = $facebook->api('/gunsdaily1');


	// sets up the variables for my simple array which is just a sliced version of the main FaceBook array.
	$fb=array(
		"likes"		=>	$user_profile["likes"],
		"talking"	=>	$user_profile["talking_about_count"],
		"image"		=>	$user_profile["cover"]["source"]
	);

	// uncomment to check if the facebook array works
	// print_r($user_profile);
?>

<!-- The hidden code is to check if the FaceBook array works -->
<!-- <?php print_r($fb); ?> -->







<?php // INSTAGRAM STATS

	$url = 'https://api.instagram.com/v1/users/300541964/?access_token=262351.467ede5.176ab1984b1d47e6b8dea518109d7a5e';
	$api_response = file_get_contents($url);
	$record = json_decode($api_response);

	// sets up the variables for my simple array which is just a sliced version of the main FaceBook array.
	$ig=array(
		"followers"	=>	$record->data->counts->followed_by,
		"following"	=>	$record->data->counts->follows,
		"images"	=>	$record->data->counts->media
	);

	// uncomment to check if the facebook array works
	//	echo '<pre>' . print_r($api_response, true) . '</pre>';
	//	echo '<pre>' . print_r($record, true) . '</pre>';


?>

<!-- The hidden code is to check if the Instagram array works -->
<!-- <?php print_r($ig); ?> -->





<?php // TWITTER STATS

	// Loads the Twitter SDK system for PHP
	require_once('external/TwitterAPIExchange.php');

	// Create our Application instance that allows connecting to Twitter.
	$settings = array(
		'oauth_access_token' => "545371167-irULMOms3sQrOaNwsL73EWeXDHLfy6PmYWrE2FMU",
		'oauth_access_token_secret' => "Zv9cS7OsiGXXuARfG92lj6UvO5yQwBjH16e987zEmtpjU",
		'consumer_key' => "7eJxfBBdxGoYf1BcPetNi9whC",
		'consumer_secret' => "pXTgOEQO804GWeZxPmXMqFmKTgrSc3KVs8GEH6M9tpHEL9wMpb"
	);

	// This call will always work since we are fetching public data.
	$url = 'https://api.twitter.com/1.1/users/show.json';
	$getfield = '?screen_name=gunsdaily';
	$requestMethod = 'GET';

	// Generate responce through the exchange
	$twitter = new TwitterAPIExchange($settings);

	// Build in Oauth and request data
	$response = $twitter
		->setGetfield($getfield)
		->buildOauth($url, $requestMethod)
		->performRequest();

	// Decode json file into array
	$user = json_decode($response);

	// sets up the variables for my simple array which is just a sliced version of the main FaceBook array.
		$tw=array(
			"followers"		=>	$user->followers_count,
			"following"		=>	$user->friends_count,
			"favourites"	=>	$user->favourites_count,
			"tweets"		=>	$user->statuses_count,
			"retweets"		=>	$user->status->retweet_count
		);

	// uncomment to check if the facebook array works
	// print_r($user);
?>

<!-- The hidden code is to check if the Twitter array works -->
<!-- <?php print_r($tw); ?> -->