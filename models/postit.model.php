<?php
if (!isset($_SESSION)) {
    session_start();
}

require_once __DIR__ . '/../config/database.php';

function get_data($userid){
    $conn = db_connect();
    if ($conn) {
        $sql = "SELECT DISTINCT titre, contenu, date_post, idpostit FROM faits, postit WHERE idutilisateur = ? order by idpostit desc";
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
                // error_log($userid);
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $datas;
        } else {
            $error = mysqli_error($conn);
            // error_log("Erreur lors de la préparation de la requête: " . $error);
            mysqli_close($conn);
            return "Erreur lors de la préparation de la requête";
        }
    } else {
        // error_log("Erreur de connexion à la base de données");
        return "Erreur de connexion à la base de données";
    }
}

function get_partage($userid){
    $conn = db_connect();
    if ($conn) {
        $sql = "SELECT titre, contenu, date_post, idpostit, utilisateurs.nom, utilisateurs.prenom FROM faits, postit, utilisateurs WHERE faits.id_utilisateur_partage = ? AND faits.id_postit = postit.idpostit AND faits.id_utilisateur = utilisateurs.idutilisateur order by idpostit desc";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, "i", $userid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $datapart = [];
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $datapart[] = $row;
                }
            } else {
                // error_log("Aucun résultat trouvé pour l'utilisateur ID: $userid");
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $datapart;
        } else {
            $error = mysqli_error($conn);
            // error_log("Erreur lors de la préparation de la requête: " . $error);
            mysqli_close($conn);
            return "Erreur lors de la préparation de la requête";
        }
    } else {
        // error_log("Erreur de connexion à la base de données");
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
            // error_log("Erreur lors de la préparation de la requête: " . $error);
            mysqli_close($conn);
            return "Erreur lors de la préparation de la requête.";
        }
    } else {
        // error_log("Erreur de connexion à la base de données");
        return "Erreur de connexion à la base de données";
    }
}

// Fonction qui permet la création d'un post-it
/**
 * On récupere les données title, content, sharedUser depuis l'interface de création
 */
function create_postit($title, $content, $sharedUsers) {
    /**
     * On récupere l'id de l'utilisateur connecté grace à la session
     */
    $user = $_SESSION['user_id'];
    $conn = db_connect();
    if ($conn) {
        /**
         * On a privilégié l'utilisation des requetes préparées pour éviter les injections SQL
         */
        $sql = "INSERT INTO postit (titre, contenu, date_post, idutilisateur) VALUES (?, ?, NOW(), ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            // Une fois que la requete est préparée, on bind les parametres, on execute la requete et on recupere le resultat
            mysqli_stmt_bind_param($stmt, "ssi", $title, $content, $user);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                $last_postit_id = mysqli_insert_id($conn);
                // vérifie si des utilisateurs ont été selectionnes pour le partage dans la variable $sharedUsers si c'est le cas 
                // on ajoute dans la table des faits les utilisateurs selectionnes avec les post-its et proprietaire du post-it correspondant
                if(!empty($sharedUsers)) {
                    foreach ($sharedUsers as $sharedUserId) {
                        $stmt_shared = mysqli_prepare($conn, "INSERT INTO faits (id_postit, id_utilisateur, id_utilisateur_partage) VALUES (?, ?, ?)");
                        if ($stmt_shared) {
                            mysqli_stmt_bind_param($stmt_shared, "iii", $last_postit_id, $user, $sharedUserId);
                            mysqli_stmt_execute($stmt_shared);
                            mysqli_stmt_close($stmt_shared);
                        } else {
                            $error = mysqli_error($conn);
                            mysqli_stmt_close($stmt);
                            mysqli_close($conn);
                            return $error;
                        }
                    }
                    mysqli_close($conn);
                    return true;
                }else{
                    // si aucun utilisateur n'a été selectionné pour le partage on ajoute juste le post-it dans la table des faits
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
                        return $error;
                    }
                }
            } else {
                $error = mysqli_error($conn);
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                return $error;
            }
        } else {
            $error = mysqli_error($conn);
            mysqli_close($conn);
            return $error;
        }
    } else {
        return "Problème de connexion à la base de données";
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
        return $error;
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
        return $error;
    }
}

// Fonction qui permet de mettre à jour un postit, on récupère les données title, content, sharedUser depuis l'interface de modification
function update_postit($id, $title, $content) {
    $conn = db_connect();
    if ($conn) {
        $sql = "UPDATE postit SET titre=?, contenu=? WHERE idpostit=?";
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
            return $error;
        }
    } else {
        return "Erreur de connexion à la base de données";
    }
}

// fonction qui permet de récupérer les prénoms des utilisateurs depuis la base de données (utilisé pour l'autocomplétion du partage de post-it)
function get_prenoms($terme){
    $conn = db_connect();
    $sql = "SELECT idutilisateur, prenom FROM utilisateurs WHERE prenom LIKE ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        $terme = $terme . '%';
        mysqli_stmt_bind_param($stmt, "s", $terme);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $prenoms = [];
        if($result && mysqli_num_rows($result)> 0) {
            while ($row = mysqli_fetch_assoc($result))
                $prenoms[] = $row;
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $prenoms;
    } else {
        $error = mysqli_error($conn);
        mysqli_close($conn);
        return $error;
    }
}

function get_postit_details($id) {
    $conn = db_connect();
    if ($conn) {
        $sql = "SELECT titre, contenu FROM postit WHERE idpostit = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $postit = null;
            if ($result && mysqli_num_rows($result) > 0) {
                $postit = mysqli_fetch_assoc($result);
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $postit;
        } else {
            $error = mysqli_error($conn);
            mysqli_close($conn);
            return $error;
        }
    } else {
        return "Erreur de connexion à la base de données";
    }
}

function delete_postit($id) {
    $conn = db_connect();
    $user = $_SESSION['user_id'];
    if ($conn) {
        $sql = "DELETE FROM postit WHERE idpostit = ? AND idutilisateur = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ii", $id, $user);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                return true;
            } else {
                $error = mysqli_error($conn);
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                return "Erreur " . $error;
            }
        } else {
            $error = mysqli_error($conn);
            mysqli_close($conn);
            return $error;
        }
    } else {
        return "Erreur de connexion à la base de données";
    }
}

// fonction qui recupere les prenoms des utilisateurs avec qui le postit est partagé
// en fonction de l'id du postit et de l'id de l'utilisateur partage
function get_shared_users($postit_id) {
    $conn = db_connect();
    if ($conn) {
        $sql = "SELECT utilisateurs.idutilisateur, utilisateurs.prenom FROM faits JOIN utilisateurs ON faits.id_utilisateur_partage = utilisateurs.idutilisateur WHERE faits.id_postit = ? and id_utilisateur_partage IS NOT NULL";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $postit_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $sharedUsers = [];
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $sharedUsers[] = $row;
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $sharedUsers;
        } else {
            $error = mysqli_error($conn);
            mysqli_close($conn);
            return $error;
        }
    } else {
        return "Erreur de connexion à la base de données";
    }

}
// fonction qui permet d'ajouter les utilisateurs partagés dans la table des faits lors de la modification d'un post-it
function insert_shared_users($id_postit, $id_utilisateur, $sharedUserIds) {
    $conn = db_connect();
    if ($conn) {
        $sql = "INSERT INTO faits (id_postit, id_utilisateur, id_utilisateur_partage) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            foreach ($sharedUserIds as $id_utilisateur_partage) {
                mysqli_stmt_bind_param($stmt, "iii", $id_postit, $id_utilisateur, $id_utilisateur_partage);
                $result = mysqli_stmt_execute($stmt);
                if (!$result) {
                    $error = mysqli_error($conn);
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    return $id_utilisateur_partage. "Erreur: " . $error;
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return true;
        } else {
            $error = mysqli_error($conn);
            mysqli_close($conn);
            return $error;
        }
    } else {
        return "Erreur de connexion à la base de données";
    }
}
// fonction qui permet de recuperer l'id de l'utilisateur du créateur du postit a partir de l'id de l'un de ses postits
function get_user_id_from_postit($id_postit){
    $conn = db_connect();
    if ($conn) {
        $sql = "SELECT id_utilisateur FROM faits WHERE id_postit = ? LIMIT 1";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $id_postit);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $id_utilisateur = null;
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $id_utilisateur = $row['id_utilisateur'];
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return $id_utilisateur;
        } else {
            $error = mysqli_error($conn);
            mysqli_close($conn);
            return $error;
        }
    } else {
        return "Erreur de connexion à la base de données";
    }
}

// fonction permettant de supprimer un enregistrement de la table des faits en fonction de l'id_postit et l'id_utilisateur_partage (lors de la modification d'un post-it)
// Cette fonction supprime tous les post-it dans la table des faits avec l'id_utilisateur (prorio) au lieu de supprimer seulement celui spécifier (dû surement à un défaut d'architecture base de donnée)
function delete_shared_users($id_postit, $sharedUserIds) {
    $conn = db_connect();
    if ($conn) {
        $sql = "DELETE FROM faits WHERE id_postit = ? AND id_utilisateur_partage = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            foreach ($sharedUserIds as $id_utilisateur_partage) {
                mysqli_stmt_bind_param($stmt, "ii", $id_postit, $id_utilisateur_partage);
                $result = mysqli_stmt_execute($stmt);
                if (!$result) {
                    $error = mysqli_error($conn);
                    mysqli_stmt_close($stmt);
                    mysqli_close($conn);
                    return $id_utilisateur_partage. "Erreur: " . $error;
                }
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return true;
        } else {
            $error = mysqli_error($conn);
            mysqli_close($conn);
            return $error;
        }
    } else {
        return "Erreur de connexion à la base de données";
    }
}
?>