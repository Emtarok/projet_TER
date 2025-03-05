<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once __DIR__ . '/../models/profil.model.php';

function handle_request() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?action=connexion');
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $user = get_user_profile($user_id);

    if ($user) {
        require_once __DIR__ . '/../views/profil.view.php';
    } else {
        echo "Utilisateur non trouvé";
    }
}
?>
