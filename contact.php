<?php 
    // include the configs / constants for the database connection
    require_once("config/db.php");
    // Load header
    include './assets/header.php';
    // load the login class
    require_once("classes/Login.php");
    // Process the page loading
    require("classes/ProcessPage.php");

    $activeTab = "contact";
    
    // Load navbar
    include './assets/navbar.php';

    // Includes slider
    require './assets/slider.php';


    // if logged in display content
    if ($login->isUserLoggedIn() == true) {
        include("views/v-contact-in.php");
    } else {
        include("views/v-cotact-in.php");
    }


    // Load footer
    include("assets/footer.php");
?>