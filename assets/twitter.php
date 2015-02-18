<?php // TWITTER STATS
    
    $twitterFeedCount = 3;

    // Loads the Twitter SDK system for PHP
    require_once('TwitterAPIExchange.php');

    // Create our Application instance that allows connecting to Twitter.
    $settings = array(
        'oauth_access_token' => "545371167-irULMOms3sQrOaNwsL73EWeXDHLfy6PmYWrE2FMU",
        'oauth_access_token_secret' => "Zv9cS7OsiGXXuARfG92lj6UvO5yQwBjH16e987zEmtpjU",
        'consumer_key' => "7eJxfBBdxGoYf1BcPetNi9whC",
        'consumer_secret' => "pXTgOEQO804GWeZxPmXMqFmKTgrSc3KVs8GEH6M9tpHEL9wMpb"
    );





    // This call will always work since we are fetching public data.
    $url = 'https://api.twitter.com/1.1/users/show.json';
    $getfield = '?screen_name=minetract';
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





    // This call will always work since we are fetching public data.
    $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
    $getfield = '?screen_name=minetract&count=' . $twitterFeedCount;
    $requestMethod = 'GET';

    // Generate responce through the exchange
    $twitter = new TwitterAPIExchange($settings);

    // Build in Oauth and request data
    $response = $twitter
        ->setGetfield($getfield)
        ->buildOauth($url, $requestMethod)
        ->performRequest();

    // Decode json file into array
    $tweets = objectToArray(json_decode($response));





    // sets up the variables for my simple array which is just a sliced version of the main FaceBook array.
        $tw = array(
            "followers"     =>  $user->followers_count,
            "following"     =>  $user->friends_count,
            "favourites"    =>  $user->favourites_count,
            "tweets"        =>  $user->statuses_count,
            "retweets"      =>  $user->status->retweet_count
        );

    // uncomment to check if the twitter array works
    // echo "<pre>";
    // print_r($tweets);
    // echo "</pre>";

    $i = 0;

    // echo "<div class='twitter'>";
    // echo "<img src='" . $tweets[0]['user']['profile_image_url_https']. "'>";
    // echo "<h3>Minetract Twitter</h3>";
    // echo "<b>" . $tw['followers'] . " followers, " . $tw['following'] . " following</b>";

    if (count($tweets) < $twitterFeedCount) {
        $twitterFeedCount = count($tweets);
    }

    while ( $i < $twitterFeedCount) {       

        $usersTimezone = 'America/New_York';
        $date = new DateTime( $tweets[$i]['created_at'], new DateTimeZone($usersTimezone) );
        $date = $date->format("h:ia - dS F");

        if ($tweets[$i]['favorited'] > 0) {
            $fav = $tweets[$i]['favorited'] . " favorites &nbsp;&nbsp;&nbsp;";
        } else {
            $fav = "";
        }

        if ($tweets[$i]['retweeted'] > 0) {
            $rt = $tweets[$i]['retweeted'] . " retweets";
        } else {
            $rt = "";
        }
        // echo "<a href='https://twitter.com/minetract/status/" . $tweets[$i]['id'] . "' target='_blanks'>";
        // echo "<span class='sexy_line'></span>";
        // echo $tweets[$i]['text']; 
        // echo "<div class='inner'>";
        // echo "<div class='fav'>" . $fav . $rt . "</div>";
        // echo "<div class='date'>" . $date . "</div>";
        // echo "</div>";
        // echo "</a>";

        echo "
        <a href='https://twitter.com/minetract/status/" . $tweets[$i]['id'] . "' target='_blank'>
            <div class='news-post animate'>
                <h3>" . $tweets[$i]['text'] . "</h3>
                <h5>" . $date . "</h5>
                <a class='profile' href='https://twitter.com/minetract' target='_blank'> 
                    By&nbsp;&nbsp;<h4 class='animate'>
                        <img src='" . $tweets[0]['user']['profile_image_url_https'] . "'>
                        Minetract
                    </h4>
                </a>

                 " . $fav . $rt . "


            </div>
        </a>
        ";
        $i++;
    }

    // echo "</div>";
?>