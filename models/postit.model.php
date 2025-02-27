<?php
require_once __DIR__ . '/../config/database.php';

function get_data($userid){
	$conn = db_connect();
    if ($conn) {
        $sql = "SELECT postit.titre, postit.contenu, postit.date FROM faits, postit WHERE '$userid' = faits.id_utilisateur AND faits.id_post = postit.idpost ";
        $result = mysqli_query($conn, $sql);
        $datas = [];
        if ($result && mysqli_num_rows($result)>0 ) {
            while ($row = mysqli_fetch_assoc($result)) {
                $datas[] = $row;
            }
        }
        mysqli_close($conn);
        return $datas;
    } else {
        return "Erreur de connexion à la base de données";
    }
}

function create_postit($title, $content) {
    $conn = db_connect();
    if ($conn) {
        $sql = "INSERT INTO postit (titre, contenu, date_post) VALUES ('$title', '$content', NOW())";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            mysqli_close($conn);
            return $result;
        } else {
            $error = mysqli_error($conn);
            mysqli_close($conn);
            return $error;
        }
    } else {
        return "Erreur de connexion à la base de données";
    }
}

// fonction qui permet de récupérer les prénoms des utilisateurs depuis la base de données (utilisé pour l'autocomplétion du partage de post-it)
function get_prenoms($terme){
    $conn = db_connect();
    $sql = "SELECT prenom FROM utilisateurs WHERE prenom LIKE '$terme%';";
    $result = mysqli_query($conn, $sql);

    $prenoms = [];
    if($result && mysqli_num_rows($result)> 0) {
        while ($row = mysqli_fetch_assoc($result))
            $prenoms[] = $row["prenom"];
    }else{

    }

    mysqli_close($conn);
    return $prenoms;
}

?>