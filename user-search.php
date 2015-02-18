<?php 
    // include the configs / constants for the database connection
    require_once("config/db.php");
    // load the login class
    require_once($mt_path . "classes/Login.php");
    // Process the page loading
    require($mt_path . "classes/ProcessPage.php");

    $overrideTitleName = "Users Search";
    
    // Load header
    include ($mt_path . "assets/header.php");

    $activeTab = "users";

    // Load navbar
    include ($mt_path . "assets/navbar.php");

    // if logged in display content
    if ($login->isUserLoggedIn() == true) {
        include($mt_path . "views/v-users-search.php");
    } else {
        include($mt_path . "views/v-users-search.php");
    }


    // Load footer
    include($mt_path . "assets/footer.php");
?>