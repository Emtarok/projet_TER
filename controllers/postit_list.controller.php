<?php
require_once __DIR__ . '/../models/postit.model.php';

function handle_request() {
    $action = isset($_GET['action']) ? $_GET['action'] : 'home';
    switch ($action) {
        case 'list':
            $userid = get_data($_SESSION);
            // si récupération du numéro de session en cours non nul (utilisateur connecté) -> OK
            // je ne vérifie pas si utilisateur dans la bdd, car déjà fait lors de la connexion.
            if (isset($userid)) {
                require_once __DIR__ . '/../views/postit_details.view.php';
            }
            else {
                echo "Erreur lors de la récupération des données. Pas d'utilisateur connecté.";
            }
            break;
        
        case 'details':
            require_once __DIR__ . '/../views/postit_details.view.php';
            break;
        
        default:
            echo "Page non trouvée.";
    }
}
?>