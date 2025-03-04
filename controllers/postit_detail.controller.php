<?php
if (!isset($_SESSION)) {
    session_start();
}
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
                $postitdetail = postit_id($postitid);
                if ($postitdetail) {
                    require_once __DIR__ . '/../views/postit_detail.view.php';
                } else {
                    echo "Postit non trouvé";
                }
            } else {
                echo "ID de postit vide";
            }
            break;
        
        default:
            require_once __DIR__ . '/controllers/controller.php';
            break;
    }
}
?>