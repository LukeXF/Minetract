<?php 
    // include the configs / constants for the database connection
    require_once("../config/db.php");
    // load the login class
    require_once($mt_path . "classes/Login.php");
    // Process the page loading
    require($mt_path . "classes/ProcessPage.php");

    $overrideTitleName = "News";
    
    // Load header
    include ($mt_path . "assets/header.php");

    $activeTab = "news";

    // Load navbar
    include ($mt_path . "assets/navbar.php");

    // if logged in display content
    if ($login->isUserLoggedIn() == true) {
        
        // Load the poosts          
        $DB_HOST = DB_HOST;
        $DB_NAME = DB_NAME;


        // load the user data of who posted each news post
        try{
            $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", DB_USER, DB_PASS);
            // Communication
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $dbh->prepare("SELECT * FROM `news_comments` where `newsc_id` = '" . $_POST['news_post'] . "' and `newsc_post` = '" . $_POST['news_comment_id'] . "'" );
            $stmt->execute();
            $comments=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $dbh = null;

        } catch(PDOException $e) { 
            echo $e->getMessage(); 
        }

        // echo "<pre>";
        // print_r($comments);
        // print_r($_POST);
        // print_r($_SESSION);
        // echo "</pre>";



        $dbh = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME", DB_USER, DB_PASS);
        // Communication
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM `news_comments` WHERE newsc_id =  :newsc_id AND newsc_user =  :newsc_user";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':newsc_id', $comments[0]['newsc_id'], PDO::PARAM_INT);   
        $stmt->bindParam(':newsc_user', $_SESSION['user_id'], PDO::PARAM_INT);   
        $stmt->execute();

       echo " 
        <script language='javascript'>
            window.location.href = '" . $mt_url . "news?post=" . $_GET['post'] ."'
        </script>
        ";

    } else {
        include($mt_path . "views/v-news.php");
    }


    // Load footer
    include($mt_path . "assets/footer.php");
?>