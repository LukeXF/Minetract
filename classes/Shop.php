<?php
    $userdb = DB_USER;
    $passdb = DB_PASS;
    $hostdb = DB_HOST;
    $namedb = DB_NAME;

    // Limits the amount of letters into a smaller more manageable word limited short view.
    function limit_desc($text, $limit) {
        if (str_word_count($text, 0) > $limit) {
                $words = str_word_count($text, 2);
                $pos = array_keys($words);
                $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }

    // Creates the product array table that lists all the products and their values
    $fullProductArray = array();

    try {
        // Connect and create the PDO object
        $conn = new PDO("mysql:host=$hostdb; dbname=$namedb", $userdb, $passdb);
        $conn->exec("SET CHARACTER SET utf8");      // Sets encoding UTF-8

        // Define and perform the SQL SELECT query
        $sql = "SELECT * FROM `store` $productType";
        $result = $conn->query($sql);

        // Counter to increment array
        $ProductCounter = 0;

        // Parse returned data, and displays them
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $fullProductArray['Product ' . $row['store_id'] ]['Product ID'] = $row['store_id'];
            $fullProductArray['Product ' . $row['store_id'] ]['Product Price'] = $row['store_price'];
            $fullProductArray['Product ' . $row['store_id'] ]['Product Name'] = $row['store_name'];
            $fullProductArray['Product ' . $row['store_id'] ]['Product Desc'] = $row['store_desc'];
            $fullProductArray['Product ' . $row['store_id'] ]['Number In Array'] = $ProductCounter;
            $fullProductArray['Product ' . $row['store_id'] ]['Product Rating'] = $finalAverageRating["Product " . $row['store_id']];

            $ProductCounter++;
        }

        $conn = null;        // Disconnect
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
?>