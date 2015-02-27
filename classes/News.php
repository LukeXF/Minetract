<?php

// Handles the news system
class News
{
    // setup the predefined variables of this class
    private $db_connection            = null; // object $db_connection The database connection

    // the function "__construct()" automatically starts whenever an object of this class is created,
    // this is done with "$login = new Login();"
    public function __construct()
    {
        
       

    }

    // Checks if database connection is opened and open it if not (the start of all queries for registration)
    private function databaseConnection()
    {
        // connection already opened
        if ($this->db_connection != null) {

            // there is already a connection open so return true
            return true;

        } else {

            // create a database connection, using the constants from config/config.php
            try {

                // create the start of PDO query
                $this->db_connection = new PDO('mysql:host='. DB_HOST .';dbname='. DB_NAME . ';charset=utf8', DB_USER, DB_PASS);

                // return true now that the connection is opened
                return true;

            } catch (PDOException $e) {

                // If an error is catched, database connection failed
                $this->errors[] = "Database connection problem.";

                // return false :(
                return false;

            }
        }
    }

    // translate the string into a string with dashes that is url friendly
    private function toDashes($text) { 
	    $text = strtolower(htmlentities($text)); 
	    $text = str_replace(get_html_translation_table(), " ", $text);
	    $text = str_replace(" ", "-", $text);
	   	return $text;
	}

	// translates a url friendly string back to the standard wording
	private function toSpaces($string) {
		$string = str_replace("-", " ", $string);
		return $string;
	}


	// display the latest news feed
	public function getNewsFeed($amount, $mainfeed = false) 
	{

		// if this feed is the full feed or not
		if ($mainfeed) {
			// set posts to 200 words
			$wordLength = 200;
			// set column width to max (12)
			$columnWidth = '12';
			// if display amount is less than 20
			if ($amount < 20) {
				// force to display 20 limit
				$amount = 20;
			}
		} else {
			// set post to 50 words
			$wordLength = 50;
			// set the column to a third (4)
			$columnWidth = '4';

		}

 		// if database connection opened
        if ($this->databaseConnection()) {

            // database query, get all news posts earliest first
            $query_news = $this->db_connection->prepare("SELECT * FROM `news` ORDER BY `news_date` 
		    													DESC LIMIT :amount");
		    // prepared statement for the amount, as an int!
		    $query_news->bindValue(':amount', $amount, PDO::PARAM_INT);
		    // execute query
		    $query_news->execute();

            // fetch all from the news query 
            $newsfeed = $query_news->fetchAll();


		    	// if there is actually some results then continue to echo them out
				if ($query_news->rowCount() > 0) {

					// count the amount of news returned from the query
					$count = count($newsfeed);
					// add a counter to start incrementing 
					$i = 0;					
					// place all results inside a class for formatting
					echo "<div class='newsfeed_row row'>";

					// loop through each news post with this while loop until $i equals the total amount of users
					while ($i < $count) {

						// create a new instance of the site functions to get the usertag and other functions
						$SiteFunctions2 = new SiteFunctions();

						// set the author ID of that post to a variable 
						$author_id = $newsfeed[$i]['news_author'];
						// returns the username of the author and set it to a variable
						$author_username = $SiteFunctions2->getUserDatafromID($author_id);
						// returns the usertag of the author's username
						$author_usertag = $SiteFunctions2->userTag($author_username);
						// query string to time ready to be outputed through the php date function
						$formatted_date = strtotime($newsfeed[$i]['news_date']);
						// the url friendly title
						$url_title = $this->toDashes($newsfeed[$i]['news_title']);

						echo "
								<div class='col-md-" . $columnWidth . "'>
									<div class='well newspost'>			
										<a href='" . $GLOBALS['domain'] . "news?post=" . $url_title . "'>
											<h5>" . $newsfeed[$i]['news_title'] . "</h5>
										 	" . $this->limit_text($newsfeed[$i]['news_content'], $wordLength) . "</p>

											<a href='news/?post=" . $this->toDashes($newsfeed[$i]['news_title']) . "'>
						 						<h5 class='date'>" . date("h:ia - dS M", $formatted_date) . "</h5>
												" . $author_usertag . "

											</a>

										</a>		
									</div>					
								</div>
								
							";
						// add one to the counter
						$i++;
					}

					// close off the class and therefore all data inside
					echo "</div>";

				

				} else {
				    
				    // assume that the system is with no users so return a message informing there is no users yet
				    echo "There is no newsfeed to display, <a href='" . $GLOBALS['domain'] . "users/" . $latestUsers[$i]['user_name'] . ">";
				}

        } else {

            // if invalid username
            return false;
        }
  
					
	}



    // debug function for outputting an array in human text
    public function debug($array) {

    	// echo out html fomratting
    	echo "<pre>";
    	// print the array in an easy to read format
    	print_r($array);
    	// echo out close html formatting 
    	echo "</pre>";
    }


    private function limit_text($text, $limit) {

    // if the string is longer than the limit
	if (str_word_count($text, 0) > $limit) {

		// get a word count with the string word count PHP function	
		$words = str_word_count($text, 2);

		// set each word as apart of an array
		$pos = array_keys($words);

		// generate the finally array
		$text = substr($text, 0, $pos[$limit]) . '<i>read more...</i>';
	}

	// return the text
	// if the limit is smaller then the word count then just output the inputted value
	return $text;

    }


}

?>