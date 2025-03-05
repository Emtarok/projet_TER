<?php
// Inclure le modèle pour accéder aux données
require_once __DIR__ . '/../models/connexion.model.php';

function handle_request() {
    $action = isset($_GET['action']) ? $_GET['action'] : 'home';

    switch ($action) {
        case 'home':
            require_once __DIR__ . '/../views/connexion.view.php';
            break;
        
        case 'list':
            require_once __DIR__ . '/../views/postit_list.view.php';
            break;  

        case 'connexion':
            require_once __DIR__ . '/../views/connexion.view.php'; 
            break;

        case 'inscription':
            require_once __DIR__ . '/../views/inscription.view.php';
            break;
        
        case 'deconnexion':
            require_once __DIR__ . '/../views/connexion.view.php';
            break;

        default:
            require_once __DIR__ . '/../views/404.view.php';
            break;
    }
}
?>