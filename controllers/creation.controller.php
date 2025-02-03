<?php
require_once __DIR__ . '/../models/postit.model.php';

function handle_request() {
    $action = isset($_GET['action']) ? $_GET['action'] : 'home';
    switch ($action) {
    case 'create':
            require_once __DIR__ . '/../views/creation.view.php';
            break;
        
        default:
            echo "Page non trouvée.";
    }
}
?>