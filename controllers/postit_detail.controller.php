<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once __DIR__ . '/../models/postit.model.php';

function handle_request() {
    $action = isset($_GET['action']) ? $_GET['action'] : 'home';

    if ($action === 'details') {
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
    } else {
        require_once __DIR__ . '/../controllers/controller.php';
    }
}
?>