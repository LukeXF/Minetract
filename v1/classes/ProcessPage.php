<?php
	/* This PHP file contains all the neccisary loading for all the pages */

	if (version_compare(PHP_VERSION, '5.3.7', '<')) {
		exit("You must run PHP on atleast version 5.3.7 to allow for password secuirty.");
	} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
		require_once("assets/password_compatibility_library.php");
	}

	// Handles login status
	$login = new Login();

	// Gratar intergration to load email from sessions and display
	$email = $_SESSION['user_email'];
	$default = "http://demo.luke.sx/minetract/assets/img/logo-img.png";
	$size = 120;

	$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
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

	// Navbar logged in status
	if ($login->isUserLoggedIn() == true) {
	   $navlogin = "Welcome <b>" . $_SESSION['user_name'] . "&nbsp;</b>&nbsp;<img class='account-avatar' width='30px' src='" . $grav_url . "'>";
	   $loginH1DisplayTag = "Welcome <b>" . $_SESSION['user_name'] . "&nbsp;</b>&nbsp;<img class='account-avatar' src='" . $grav_url . "'>";

	} else {
	    $navlogin = "Login";
	    $loginH1DisplayTag  = "Login";

	}

	// UUID Check
//	$uuidLength = $_SESSION['user_uuid'];
//	if (strlen($uuidLength) > 0) {
//	    $isVerified = true;
//	} else {
//	    $isVerified = false;
//	}

//	if ($isVerified == true) {
//	    $VerifiedBoxDisplay = array(
//	    "btn-success verified",
//	    "verified");
//	} else {
//	    $VerifiedBoxDisplay = array(
//	    "btn-danger notverified",
//	    "verified");
//	}



// Set the user's account type to a variable for the switch statement
$accountType = $_SESSION['user_type'];

// Load the user's account type into the switch statement
switch ($accountType) {





    /*  This is an unconfirmed account user.
        --- 
        They have access to create no shops and they need to 
        verify their email (with the email sent to them).
        Doing anything will tell them to confirm their account
        to continue.
    */
    case '0':
        $accountType = array(
            'id'            => 0, 
            'name'          => 'Unconfirmed', 
            'shops'         => '0', 
            'commission'    => 5
        );
        break;








    /*  This is a standard free account user.
        ---
        They have access to create the one shop and act as a
        standard user across the site.
    */
    case '1':
        $accountType = array(
            'id'            => 1, 
            'name'          => 'Free', 
            'shops'         => '1', 
            'commission'    => 5
        );
        break;







    /*  This is a paid, business account user.
        ---
        They pay a fixed amount each month to use this account.

        They will have access to the analytics page, but apart
        from that they are pretty much the same as free account 
        they will also appear in higher results on the website.
    */
    case '2':
        $accountType = array(
            'id'            => 2, 
            'name'          => 'Business', 
            'shops'         => '1', 
            'commission'    => 5
        );
        break;







    /*  This is a paid, enterprise account user.
        ---
        This person has the doe and is usually a professional guy.
        They have access to create three shop and also can use the
        analytics page.

        This account type is seen as a business. This account can be
        accessed by different people that work in that business and
        have priority support as well as appearing in top results.
    */
    case '3':
        $accountType = array(
            'id'            => 3, 
            'name'          => 'Enterprise', 
            'shops'         => '3', 
            'commission'    => 5 
        );
        break;








    /*  This is a free managed account.
        ---
        This person is someone who tends not to have a brand image
        and needs help setting up their portfolio.

        They can only be assigned this account by an admin and will
        have support from other talent managers to edit their portfolio
        and build their account.

        They get this free account in return for a 20% commission taken
        back to the company.
    */
    case '4':
        $accountType = array(
            'id'            => 4, 
            'name'          => 'Managed', 
            'shops'         => '3', 
            'commission'    => 20
        );
        break;







    /*  This is an assistant account.
        ---
        This the same as a standard account type except the user will
        have access to edit other users shops and forums post.
        They're basically what we like to call a moderator.
    */
    case '5':
        $accountType = array(
            'id'            => 5, 
            'name'          => 'Assistant', 
            'shops'         => '1', 
            'commission'    => 5
        );
        break;






    /*  This is an admin account.
        ---
        They can edit other people's portfolio and is just like an
        enterprise account because we run this shit so we get the
        best stuff. YEAH!
    */
    case '6':
        $accountType = array(
            'id'            => 6, 
            'name'          => 'Admin', 
            'shops'         => '3', 
            'commission'    => 5
        );
        break;






    /*  Fall back settings
        ---
        If the server is on fire and the world is ending default to
        the magical free account.
    */
    default:
        $accountType = array(
            'id'            => 1, 
            'name'          => 'Free', 
            'shops'         => '1', 
            'commission'    => 5
        );
        break;

}


?>