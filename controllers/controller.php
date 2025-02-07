<?php
// Inclure le modèle pour accéder aux données
require_once __DIR__ . '/../models/connexion.model.php';

function handle_request() {
    $action = isset($_GET['action']) ? $_GET['action'] : 'home';

    switch ($action) {
        case 'home':
            $data = get_data(); // Appel au modèle
            require_once __DIR__ . '/../views/connexion.view.php'; // Charger la vue
            break;

        default:
            echo "Page non trouvée.";
    }
}
?>
