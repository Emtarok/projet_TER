<?php
require_once __DIR__ . '/../config/database.php';

function get_data() {
    $conn = db_connect();
    $sql = "SELECT * FROM faits";
    $result = mysqli_query($conn, $sql);

    $data = [];
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }

    mysqli_close($conn);
    return $data;
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

function get_title($id) {
    $conn = db_connect();
    $sql = "SELECT titre FROM postit WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $title = "";
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $title = $row['titre'];
    }
    mysqli_close($conn);
    return $title;
}

function get_content($id) {
    $conn = db_connect();
    $sql = "SELECT contenu FROM postit WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $content = "";
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $content = $row['contenu'];
    }
    mysqli_close($conn);
    return $content;
}

function update_postit($id, $title, $content) {
    $conn = db_connect();
    if ($conn) {
        $sql = "UPDATE postit SET titre='$title', contenu='$content' WHERE id=$id";
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
?>