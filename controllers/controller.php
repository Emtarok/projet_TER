<?php
// Inclure le modèle pour accéder aux données
require_once __DIR__ . '/../models/connexion.model.php';

function handle_request() {
    $action = isset($_GET['action']) ? $_GET['action'] : 'home';

    switch ($action) {
        case 'home':
            require_once __DIR__ . '/../views/connexion.view.php';
            break;

        case 'connexion':
            require_once __DIR__ . '/../views/connexion.view.php'; 
            break;

        case 'inscription':
            require_once __DIR__ . '/../views/inscription.view.php';
            break;

        default:
            echo "Page non trouvée.";
    }
}
?>