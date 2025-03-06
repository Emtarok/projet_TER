<?php
require_once __DIR__ . '/../config/database.php';

function get_data($email) {
    $user = null;
    $conn = db_connect();

    $sql = "SELECT * FROM utilisateurs WHERE email = ?";
    $stm = mysqli_prepare($conn, $sql);

    if ($stm) {

        mysqli_stmt_bind_param($stm, "s", $email);
        mysqli_stmt_execute($stm);
        $result = mysqli_stmt_get_result($stm);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
        }
    }else{
        if (!$stm) {
            die("Erreur de préparation de la requête SQL : " . mysqli_error($conn));
        }
    }
    // echo $user['email'];
    mysqli_close($conn);

    return $user;
}
?>