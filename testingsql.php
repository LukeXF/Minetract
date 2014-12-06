<?php
    // include the configs / constants for the database connection
    require_once("config/db.php");
    include './assets/header.php';

    $activeTab = "Home";

    // Load navbar
    include './assets/navbar.php';
?>
<div class="white">
    <div class="container">
        <div class="row grey-featured featured">
            <div class="col-md-6">              
                <h3>List of databases:</h3>


                <hr>
                    <h3>
                        <?php echo $_SESSION['user_name']; 


                            $servername = "localhost";
                            $username = "gunstest";
                            $password = "gunstest";

                            $dbname = "MinetractSuper";

                            // Create connection
                            $conn = new mysqli($servername, $username, $password, $dbname);
                            // Check connection
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            } 

                            $sql = "SELECT user_id FROM users";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "id: " . $row["user_id"].  "<br>";
                                }
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
?>
                    </h3>
                <hr>

                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
            </div>
        </div>
    </div>
</div>



<?php
    // Load footer
    include("assets/footer.php");

?>