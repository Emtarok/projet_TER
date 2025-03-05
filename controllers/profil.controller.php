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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $date_naissance = $_POST['date_naissance'];

        // Mettre à jour les informations de l'utilisateur
        $success = update_user_profile($user_id, $prenom, $nom, $pseudo, $email, $date_naissance);

        if ($success) {
            $user = get_user_profile($user_id);
        } else {
            echo "Erreur lors de la mise à jour du profil";
        }
    }

    if ($user) {
        require_once __DIR__ . '/../views/profil.view.php';
    } else {
        echo "Utilisateur non trouvé";
    }
}
?>
