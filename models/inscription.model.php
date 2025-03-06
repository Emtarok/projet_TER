<?php
require_once __DIR__ . '/../config/database.php';
/*
set_data() : a partir des informations saisie dans le formulaire d'inscription, elle les insère dans la base de données
parametres : $nom, $prenom, $email, $date_naissance, $pseudo, $password
retourne true si l'insertion est effectuée avec succès sinon retourne false
*/
function set_data($nom, $prenom, $email, $date_naissance, $pseudo, $password) {
    $conn = db_connect();

    // Vérification de l'unicité de l'email
    $verif_sql = "SELECT idutilisateur FROM utilisateurs WHERE email = ?";
    $verif_stmt = mysqli_prepare($conn, $verif_sql);
    mysqli_stmt_bind_param($verif_stmt, "s", $email);
    mysqli_stmt_execute($verif_stmt);
    $result = mysqli_stmt_get_result($verif_stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        mysqli_stmt_close($verif_stmt);
        mysqli_close($conn);
        // return ["success" => false, "message" => "Cet email est déjà utilisé. Veuillez en choisir un autre."];
        return false;
    }

    mysqli_stmt_close($verif_stmt);
    //Requête d'insertion dans la table utilisateurs
    $sql = "INSERT INTO utilisateurs (nom, prenom, email, date_naissance, pseudo, motdepasse) VALUES (?, ?, ?, ?, ?, ?)";
    $stm = mysqli_prepare($conn, $sql);
    //Requête d'insertion dans la table faits
    $sqlf = "INSERT INTO faits (id_utilisateur) VALUES (?)";
    $stmf = mysqli_prepare($conn, $sqlf);

    mysqli_stmt_bind_param($stm, "ssssss", $nom, $prenom, $email, $date_naissance, $pseudo, $password);
    $result = mysqli_stmt_execute($stm);

    $last_id = mysqli_insert_id($conn);
    mysqli_stmt_bind_param($stmf, "i", $last_id);
    $resultf = mysqli_stmt_execute($stmf);

    if ($result) {
        // $response = ["success" => true, "message" => "Utilisateur ajouté avec succès"];
        $response = true;
    } else {
        // $response = ["success" => false, "message" => "Erreur lors de l'ajout de l'utilisateur"];
        $response = false;
    }

    mysqli_stmt_close($stm);
    mysqli_stmt_close($stmf);
    mysqli_close($conn);

    return $response;
}
?>




