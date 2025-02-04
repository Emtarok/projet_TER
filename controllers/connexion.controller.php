<?php
// Inclure le modèle pour accéder aux données
require_once __DIR__ . '/../models/connexion.model.php';

function handle_request() {
    $action = isset($_GET['action']) ? $_GET['action'] : 'home';

    switch ($action) {
        case 'connexion':
            require_once __DIR__ . '/../views/postit_list.view.php';
            break;
    
        case 'inscription':
            require_once __DIR__ . '/../views/inscription.view.php';
            break;

        case 'details':
            require_once __DIR__ . '/../views/postit_detail.view.php';
            break;
        
        case 'liste':
            require_once __DIR__ . '/../views/postit_list.view.php';
            break;

        default:
            echo "Page non trouvée.";
    }
}
?>