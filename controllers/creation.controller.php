<?php
require_once __DIR__ . '/../models/postit.model.php';

function handle_request() {
    $action = isset($_GET['action']) ? $_GET['action'] : 'home';
    switch ($action) {
        case 'create':
            require_once __DIR__ . '/../views/creation.view.php';
            break;

        case 'create_postit':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['title']) && isset($_POST['content'])) {
                    $title = $_POST['title'];
                    $content = $_POST['content'];
                    $result = create_postit($title, $content);
                    if ($result === true) {
                        header('Location: ?action=create');
                        exit();
                    } else {
                        echo $result;
                    }
                } else {
                    echo "Veuillez remplir tous les champs";
                }
            }
            require_once __DIR__ . '/../views/creation.view.php';
            break;

        case 'update':
            require_once __DIR__ . '/../views/update.view.php';
            break;
        
        case 'update_postit':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['content'])) {
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $content = $_POST['content'];
                    $result = update_postit($id, $title, $content);
                    if ($result === true) {
                        header('Location: ?action=list');
                        exit();
                    } else {
                        echo $result;
                    }
                } else {
                    echo "Veuillez remplir tous les champs";
                }
            }
            require_once __DIR__ . '/../views/update.view.php';
            break;

        default:
            echo "Page non trouvée.";
    }
}
?>