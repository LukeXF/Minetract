<?php 
    // include the configs / constants for the database connection
    require_once("config/db.php");
    // load the login class
    require_once("classes/Login.php");

    $isThisTheMaintenancePage = true;

    // Process the page loading
    require("classes/ProcessPage.php");
    // Load header
    include './assets/header.php';

    $activeTab = "Home";

    // Load navbar
    include './assets/navbar.php';

    // if logged in display content
    if ($login->isUserLoggedIn() == true) {
        include("views/v-maintenance.php");
    } else {
        include("views/v-maintenance.php");
    }


    // Load footer
    include("assets/footer.php");
?>