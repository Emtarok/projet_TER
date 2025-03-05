<?php
require_once __DIR__ . '/../config/database.php';

function get_user_profile($user_id) {
    $conn = db_connect();
    $user = null;

    $sql = "SELECT * FROM utilisateurs WHERE idutilisateur = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Erreur lors de la préparation de la requête";
    }

    mysqli_close($conn);
    return $user;
}
?>
