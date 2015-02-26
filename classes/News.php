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
	public function getNewsFeed($amount) 
	{

 		// if database connection opened
        if ($this->databaseConnection()) {

            // database query, getting all the info of the selected user
            $query_news = $this->db_connection->prepare("SELECT * FROM `news` ORDER BY `news_date` 
		    													DESC LIMIT :amount");
		    // prepared statement for the amount, note: has been trimmed and set to int before the query can accept an int
		    $query_news->bindValue(':amount', $amount, PDO::PARAM_INT);
		    // execute query
		    $query_news->execute();

            // get result row (as an object)
            return $query_news->fetchObject();

        } else {

            // if invalid username
            return false;
        }
  
					
	}
}

?>