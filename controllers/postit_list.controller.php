<?php
require_once __DIR__ . '/../models/postit.model.php';

function handle_request() {
    $action = isset($_GET['action']) ? $_GET['action'] : 'home';
    switch ($action) {
        case 'list':
            $data = get_data();
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