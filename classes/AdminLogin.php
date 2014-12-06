<?php

/**
 * Class login
 * handles the user's login and logout process
 */
class Login
{
    /**
     * @var object The database connection
     */
    private $db_connection = null;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct()
    {
        // create/read session, absolutely necessary
        session_start();

        // check the possible login actions:
        // if user tried to log out (happen when user clicks logout button)
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        // login via post data (if user just submitted a login form)
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }

        if (isset($_GET["user"])) {
            $this->getPlayerRequest();
        }
    }

    /**
     * log in with post data
     */
    private function dologinWithPostData()
    {
        // Loads error messages containment
        $openingAlert = "<div style='text-align:center;' class='container'><div class='row'><div class='col-md-4 col-md-offset-4'><div class='alert alert-danger center' role='alert'>";
        $closingAlert = "</div></div></div></div>";
        // check login form contents
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Username field was empty.";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "Password field was empty.";
        } elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {

            // create a database connection, using the constants from config/db.php (which we loaded in index.php)
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escape the POST stuff
                $user_name = $this->db_connection->real_escape_string($_POST['user_name']);

                // database query, getting all the info of the selected user (allows login via email address in the
                // username field)
                $sql = "SELECT user_id, user_name, user_email, user_password_hash, user_last, user_account_type, user_date_joined
                        FROM users
                        WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_name . "';";
                $result_of_login_check = $this->db_connection->query($sql);

                // if this user exists
                if ($result_of_login_check->num_rows == 1) {

					// get result row (as an object)
					$result_row = $result_of_login_check->fetch_object();
						
					// if thhe user is an admin
					if ($result_row->user_account_type == 4) {
					
						// using PHP 5.5's password_verify() function to check if the provided password fits
						// the hash of that user's password
						if (password_verify($_POST['user_password'], $result_row->user_password_hash)) {

							// write user data into PHP SESSION
							$_SESSION['user_id'] = $result_row->user_id;
							$_SESSION['user_name'] = $result_row->user_name;
							$_SESSION['user_email'] = $result_row->user_email;
							$_SESSION['user_last'] = $result_row->user_last;
							$_SESSION['user_type'] = $result_row->user_account_type;
							$_SESSION['user_date'] = $result_row->user_date_joined;
							$_SESSION['user_login_status'] = 1;
							

						} else {
							$this->errors[] = $openingAlert . "Wrong password. Try again. </div>" . $closingAlert;
						}
					} else {
						$this->errors[] = $openingAlert . "This user is not an admin" . $closingAlert;
					}
                } else {
                    $this->errors[] = $openingAlert . "This user does not exist." . $closingAlert;
                }
            } else {
                $this->errors[] = $openingAlert ."Database connection problem." . $closingAlert;
            }
        }
    }

    /**
     * perform the logout
     */
    public function doLogout()
    {
        // Loads error messages containment
        $openingAlert = "<div style='text-align:center;' class='container'><div class='row'><div class='col-md-4 col-md-offset-4'><div class='alert alert-danger center' role='alert'>";
        $closingAlert = "</div></div></div></div>";

        // delete the session of the user
        $_SESSION = array();
        session_destroy();
        // return a little feeedback message
        $this->messages[] = $openingAlert . "You have been logged out." . $closingAlert;



    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }

}

?>
