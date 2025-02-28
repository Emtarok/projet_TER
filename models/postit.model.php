<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';

function get_data($userid){
    $conn = db_connect();
    if ($conn) {
        $sql = "SELECT titre, contenu, date_post, idpostit FROM faits, postit WHERE faits.id_utilisateur = ? AND faits.id_postit = postit.idpostit order by idpostit desc";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, "i", $userid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $datas = [];
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $datas[] = $row;
                }
            } else {
                error_log("Aucun résultat trouvé pour l'utilisateur ID: $userid");
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $datas;
        } else {
            $error = mysqli_error($conn);
            error_log("Erreur lors de la préparation de la requête: " . $error);
            mysqli_close($conn);
            return "Erreur lors de la préparation de la requête";
        }
    } else {
        error_log("Erreur de connexion à la base de données");
        return "Erreur de connexion à la base de données";
    }
}

function postit_id($positid){
    $conn = db_connect();
    if ($conn) {
        $sql = "SELECT postit.titre, postit.contenu, postit.date_post, postit.idpostit FROM postit WHERE postit.idpostit = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $positid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $postitdetail = [];
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $postitdetail[] = $row;
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $postitdetail;
        } else {
            $error = mysqli_error($conn);
            error_log("Erreur lors de la préparation de la requête: " . $error);
            mysqli_close($conn);
            return "Erreur lors de la préparation de la requête.";
        }
    } else {
        error_log("Erreur de connexion à la base de données");
        return "Erreur de connexion à la base de données";
    }
}

function create_postit($title, $content) {
    $user = $_SESSION['user_id'];
    $conn = db_connect();
    if ($conn) {
        $sql = "INSERT INTO postit (titre, contenu, date_post, idutilisateur) VALUES (?, ?, NOW(), ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssi", $title, $content, $user);
            $result = mysqli_stmt_execute($stmt);

            if ($result) {
                $last_postit_id = mysqli_insert_id($conn);
                $sql_update_faits = "INSERT INTO faits (id_postit, id_utilisateur) VALUES (?, ?)";
                $stmt_update_faits = mysqli_prepare($conn, $sql_update_faits);
                if ($stmt_update_faits) {
                    mysqli_stmt_bind_param($stmt_update_faits, "ii", $last_postit_id, $user);
                    mysqli_stmt_execute($stmt_update_faits);
                    mysqli_stmt_close($stmt_update_faits);
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    return true;
                } else {
                    $error = mysqli_error($conn);
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    return "Erreur lors de la préparation de la requête de mise à jour des faits: " . $error;
                }
            } else {
                $error = mysqli_error($conn);
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                return "Erreur lors de l'exécution de la requête d'insertion du post-it: " . $error;
            }
        } else {
            $error = mysqli_error($conn);
            mysqli_close($conn);
            return "Erreur lors de la préparation de la requête d'insertion du post-it: " . $error;
        }
    } else {
        return "Erreur de connexion à la base de données";
    }
}

function get_title($id) {
    $conn = db_connect();
    $sql = "SELECT titre FROM postit WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $title = "";
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $title = $row['titre'];
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $title;
    } else {
        $error = mysqli_error($conn);
        mysqli_close($conn);
        return "Erreur lors de la préparation de la requête: " . $error;
    }
}

function get_content($id) {
    $conn = db_connect();
    $sql = "SELECT contenu FROM postit WHERE id=?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $content = "";
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $content = $row['contenu'];
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $content;
    } else {
        $error = mysqli_error($conn);
        mysqli_close($conn);
        return "Erreur lors de la préparation de la requête: " . $error;
    }
}

function update_postit($id, $title, $content) {
    $conn = db_connect();
    if ($conn) {
        $sql = "UPDATE postit SET titre=?, contenu=? WHERE id=?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssi", $title, $content, $id);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                return true;
            } else {
                $error = mysqli_error($conn);
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                return $error;
            }
        } else {
            $error = mysqli_error($conn);
            mysqli_close($conn);
            return "Erreur lors de la préparation de la requête de mise à jour du post-it: " . $error;
        }
    } else {
        return "Erreur de connexion à la base de données";
    }
}

// fonction qui permet de récupérer les prénoms des utilisateurs depuis la base de données (utilisé pour l'autocomplétion du partage de post-it)
function get_prenoms($terme){
    $conn = db_connect();
    $sql = "SELECT prenom FROM utilisateurs WHERE prenom LIKE ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        $terme = $terme . '%';
        mysqli_stmt_bind_param($stmt, "s", $terme);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $prenoms = [];
        if($result && mysqli_num_rows($result)> 0) {
            while ($row = mysqli_fetch_assoc($result))
                $prenoms[] = $row["prenom"];
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $prenoms;
    } else {
        $error = mysqli_error($conn);
        mysqli_close($conn);
        return "Erreur lors de la préparation de la requête: " . $error;
    }
}
?>