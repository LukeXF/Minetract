<?php 
    // include the configs / constants for the database connection
    require_once("config/db.php");
    // Load header
    include './assets/header.php';
    // load the login class
    require_once("classes/Login.php");
    // load the rating class
    require("classes/Rating.php");
    // Process the page loading
    require("classes/ProcessPage.php");

    // Load navbar
    include './assets/navbar.php';

    // Includes slider
    require './assets/slider.php';


    // Views
    include './views/v-rating.php';

    // Load footer
    include("assets/footer.php");
?>