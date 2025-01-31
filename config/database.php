<?php
function db_connect() {
    $host = "localhost";
    $dbname = "test";
    $username = "root";
    $password = "";

    $conn = mysqli_connect($host, $username, $password, $dbname);

    if (!$conn) {
        die("Erreur de connexion : " . mysqli_connect_error());
    }

    return $conn;
}
?>