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



    // generate the usertag
    public function userTag($input)
    {

    	if ($this->getUserData($input) == false) {
    		

                // If there is no error, output the the error function
               $this->error('No user found');


    	} else {

			echo "<H1>". $this->getUserData($input)->user_name . "</h1>";

	    	echo "
	    	<a class='profile' href='" . $GLOBALS['brand'] . "user/" . $username . "'> 
				By&nbsp;&nbsp;
				<h4 class='animate'>
				<img src='" . $this->get_gravatar($input) . "'>
				" . $this->getUserData($input)->user_name  . "
				</h4>
			</a>";


		}


    }




    // Search into database for the user data of user_name specified as parameter (selects all data)
    public function getUserData($username)
    {
        // if database connection opened
        if ($this->databaseConnection()) {

            // database query, getting all the info of the selected user
            $query_user = $this->db_connection->prepare("SELECT `user_id`, `user_name`, `user_email` 
        												FROM `users` 
        												WHERE `user_name` = :username OR `user_email` = :username");
            // prepared statement for the username
            $query_user->bindValue(':username', $username, PDO::PARAM_STR);
            // excute username
            $query_user->execute();

            // get result row (as an object)
            return $query_user->fetchObject();

        } else {

            // if invalid username
            return false;
        }
    }




    // debug function for error logging
    public function debug($array) {
    	echo "<pre>";
    	print_r($array);
    	echo "</pre>";
    }







    // output errors that are set by other functions in clear warning text, both outputted at the location of the function called
    // and then output to the console for a quick overview only if the debug is true in the config file.
    // This uses the PHP function debug_backtrace to local the previous function that is calling the error function.
    private function error($error) {

    	// output error on message in as much detail as possible if debug in the ocnfig file is turned on
    	if ($GLOBALS['debug'] == true) {

			// generate the caller to backtrace the function that this error function as called from
			$callers = debug_backtrace();


    		// output to the console the full error
	    	echo "<script>console.log('" . $GLOBALS['brand'] . " error: ";
	    	echo $error . 
				" in " . $callers[1]['class'] . "::" . $callers[1]['function'] . 
				" called at line " . $callers[1]['line'] . " in " . $callers[1]['file'];
	    	echo "')</script>";
	

			// output as a clear error message the error and function name
			echo  "<span class='label label-danger' title='" . $callers[1]['file'] ."'>" . $error . 
			" in " . $callers[1]['class'] . "::" . $callers[1]['function'] . 
			" called at line " . $callers[1]['line'] . "</span>";

    	}
    }




    // load the gravatar image for a defined email address
    private function get_gravatar($email, $size = 80)
    {	


    	// detect if on localhost then display a default imageset by gravtar
    	// this is because Gravatar does not allow custom default images on a private network
    	// it must be publicly accessible, therefor if on localhost the image will fail
    	if ($this->detectLocalhost()){

    		// because we're on localhost, use gravatar's pre-provided identicon 
    		$defaultSiteLogo = "identicon";

    	} else {

    		// the default logo loaded in the config file for production environments only
    		// cannot be on localhost url
			$defaultSiteLogo = urlencode($GLOBALS['logo']);

    	}


    	// create the gravtar variable by loading the gravatar url
    	$gravatar = "http://www.gravatar.com/avatar/";
    	// remove blank spaces after and convert the lowercase email address to then hd5 it up
    	$gravatar .= md5( strtolower( trim( $email ) ) );
    	// finally add the get variables for the fallback image and the size of the image to load
    	$gravatar .= "?d=" . $defaultSiteLogo . "&s=" . $size;

    	// return the image as the url ready to be inputted into a <img> tag
    	return $gravatar;
    }






	// a simple function to detect if on localhost or now
	private function detectLocalhost()
	{
		
		// tell the function that theses are the localhost names
		$localhost = array('127.0.0.1', '::1', 'localhost');


		// if the webpage matches a localhost name
		if(!in_array($_SERVER['REMOTE_ADDR'], $localhost)){

			// then return false because you're on a production environment 
			return false;

		} else {

			// then return true because the domain matches localhost and is in the array
			return true;

		}
	}





}


?>

