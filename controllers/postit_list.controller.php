<?php
require_once __DIR__ . '/../models/postit_list.model.php';

function handle_request() {
    $action = isset($_GET['action']) ? $_GET['action'] : 'home';
    switch ($action) {
        case 'list':
            $data = get_data();
            require_once __DIR__ . '/../views/postit_list.view.php';
            break;
        
        case 'details':
            echo "Action details atteinte";
            require_once __DIR__ . '/../views/postit_details.view.php';
            break;
        
        default:
            echo "Page non trouvée.";
    }
}
?>