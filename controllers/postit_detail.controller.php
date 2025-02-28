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
            if (isset($_GET['id'])) {
                $postitid = $_GET['id'];
                $postit = postit_id($postitid);
                if ($postit) {
                    require_once __DIR__ . '/../views/postit_detail.view.php';
                } else {
                    echo "Postit non trouvé";
                }
            } else {
                echo "ID de postit vide"
            }
            break;
        
        default:
            echo "Page non trouvée.";
    }
}
?>