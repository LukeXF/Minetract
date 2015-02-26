<?php

// Handles the site functions
class SiteFunctions
{
    // setup the predefined variables of this class
    private $db_connection            = null; // object $db_connection The database connection
    public  $errors                   = array(); // array collection of error messages
    public  $messages                 = array(); // array collection of success / neutral messages
    public  $pageTitle                = null; // the page title of each page
    public 	$jumbotronTitle      	  = null;

    // the function "__construct()" automatically starts whenever an object of this class is created,
    // this is done with "$login = new Login();"
    public function __construct()
    {
        
        // set the page title
        $this->setPageTitle();

        // the title loaded from the SetPageTitle function
    	$workingTitle = $this->SetPageTitle();

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




    // Sets the title of all the pages
    public function setPageTitle() 
    {

    	// break up the page name just to get the file name with .php
    	$pageName = ucfirst(basename($_SERVER['PHP_SELF'],'.php'));

    	// if there is is an override on the file name then set the page title
		if (!empty($GLOBALS['overrideTitleName'])) {

			// override page the page name
			// useful to use if there is a page like password-reset and you want to name it 'Forgot Password'
			$pageName = $GLOBALS['overrideTitleName'];


		// if we're on the home page then assume we want to call the index page home
		} elseif ($pageName == "Index") {

			// then name the title 
			$pageName = "Home";


		}

		// return the page title ready to be referenced
    	return $GLOBALS['brand'] . " | " . $pageName;
    }




    // generates the header jumbotron
    private function createJumbotron($jumbotronTitleInput, $class)
    {
    	// build the jumbotron that displays the title and class name
    	echo "<div class='jumbotron " . $class . "'>
				<div class='container'>
					<div class='row'>
						<div class='col-md-12'>
							<h1 class='slideDown'>" . $jumbotronTitleInput . "</h1>
						</div>
					</div>
				</div>
			</div>
		";
    }




    // display the function
    public function displayJumbotron($lol = null, $class = 'smaller')
    {
    	// if there is no defined text called at the start of each page then generate text form the setPageTitle function
    	if (empty($lol)) {

    		// replace the brand name with nothing as it has been set by the page title function
    		$formattedPreText = str_replace($GLOBALS['brand'] . " | ", "", $this->setPageTitle() );

    		// return the generated jumbotron with page title (loaded form the page name)
    		return $this->createJumbotron($formattedPreText . " page", $class);

    	}

    	// return the generated jumbotron with the parameter string
    	return $this->createJumbotron($lol, $class);


    }




    // display the function
    public function userTag($username)
    {
    	echo "
    	<a class='profile' href='" . $GLOBALS['brand'] . "user/" . $username . "'> 
			By&nbsp;&nbsp;
			<h4 class='animate'>
			<img src='http://www.gravatar.com/avatar/bb5547972001fe3752726c8a51c4b8b0?d=assets%2Fimg%2Flogo-img.png&amp;s=120'>
				LukeXF
			</h4>
		</a>";


    }



    // get the emaill address, username and id of the user
    public function getUserData($username){
   				// query to search for user and return username 
                $query_update = $this->db_connection->prepare("SELECT `user_id`, `user_name`, `user_email` 
                												FROM `users` 
                												WHERE `user_name` = :username OR `user_email` = :username");
                // prepared statment for username
                $query_update->bindValue(':user_name', $user_name, PDO::PARAM_STR);
                // excute the query to update the password reset hash
                $query_update->execute();
                $result_row = $query_update->fetchObject();

                return $result_row;
    }




	/**
	 * Get either a Gravatar URL or complete image tag for a specified email address.
	 *
	 * @param string $email The email address
	 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
	 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
	 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
	 * @param boole $img True to return a complete IMG tag False for just the URL
	 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
	 * @return String containing either just a URL or a complete image tag
	 * @source http://gravatar.com/site/implement/images/php/
	 */
	function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
	    $url = 'http://www.gravatar.com/avatar/';
	    $url .= md5( strtolower( trim( $email ) ) );
	    $url .= "?s=$s&d=$d&r=$r";
	    if ( $img ) {
	        $url = '<img src="' . $url . '"';
	        foreach ( $atts as $key => $val )
	            $url .= ' ' . $key . '="' . $val . '"';
	        $url .= ' />';
	    }
	    return $url;
	}


}


?>

