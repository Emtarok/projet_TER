<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once __DIR__ . '/../models/postit.model.php';

function handle_request() {
    $action = isset($_GET['action']) ? $_GET['action'] : 'home';
    switch ($action) {
        case 'list':
            $userid = $_SESSION['user_id'];
            $data = get_data($userid);
            // si récupération du numéro de session en cours non nul (utilisateur connecté) -> OK
            // je ne vérifie pas si utilisateur dans la bdd, car déjà fait lors de la connexion.
            require_once __DIR__ . '/../views/postit_list.view.php';
            break;
        
        case 'details':
            require_once __DIR__ . '/../views/postit_details.view.php';
            break;
        
        default:
            echo "Page non trouvée.";
    }
}
?>