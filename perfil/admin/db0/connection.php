<?php 
    $servername = 'localhost:3306';
    $username = "root";
    $password = "PUC@1234";
    $dbname = "123folhas";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die ("Connection failed: " . $conn->connect_error);
    }
    else {
        // echo "Conexão Ok";
    }
?>