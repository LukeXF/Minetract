<?php 
    // include the configs / constants for the database connection
    require_once("config/db.php");
    // Load header
    include './assets/header.php';
    // load the login class
    require_once("classes/Login.php");
    require_once("classes/Registration.php");
    // Process the page loading
    require("classes/ProcessPage.php");

    // Load navbar
    include './assets/navbar.php';

    // Includes slider
    require './assets/slider.php';

    // Initializes the registration
    $registration = new Registration();


    // if logged in display content
    if ($login->isUserLoggedIn() == true) {
        include("views/v-logged-in.php");
    } else {
        include("views/v-register.php");
    }

    // Load footer
    include("assets/footer.php");
?>