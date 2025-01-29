<?php
// Inclure le modèle pour accéder aux données
require_once __DIR__ . '/../models/postit_detail.model.php';

function handle_request() {
    $action = isset($_GET['action']) ? $_GET['action'] : 'home';

    switch ($action) {
        case 'details':
            require_once __DIR__ . '/../views/postit_details.view.php';
            break;
    
        // case 'inscription':
        //     require_once __DIR__ . '/../views/postit_list.view.php';
        //     break;

        default:
            echo "Page non trouvée.";
    }
}
?>
