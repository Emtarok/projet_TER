<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once __DIR__ . '/../models/postit.model.php';

function handle_request() {
    $action = isset($_GET['action']) ? $_GET['action'] : 'home';
    switch ($action) {
        case 'list':
            if (!isset($_SESSION['user_id'])) {
                header('Location: index.php?action=connexion');
                exit();
            }
            $userid = $_SESSION['user_id'];
            $data = get_data($userid);
            // si récupération du numéro de session en cours non nul (utilisateur connecté) -> OK
            // je ne vérifie pas si utilisateur dans la bdd, car déjà fait lors de la connexion.
            require_once __DIR__ . '/../views/postit_list.view.php';
            break;
        
        case 'details':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $postitdetail = postit_id($id);
                if ($postitdetail) {
                    require_once __DIR__ . '/../views/postit_detail.view.php';
                } else {
                    echo "Post-it non trouvé";
                }
            } else {
                echo "ID du post-it manquant";
            }
            break;
        
        default:
            require_once __DIR__ . '/../controllers/controller.php';
            break;
    }
}
?>