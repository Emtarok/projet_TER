<?php
if (!isset($_SESSION)) {
    session_start();
}
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
                    // si il y a des utilisateurs qui sont selectionnes ils sont rajouté dans sharedUsers
                    $sharedUsers = isset($_POST['utilisateurs_partages']) ? json_decode($_POST['utilisateurs_partages'], true) : [];
                    $result = create_postit($title, $content, $sharedUsers);
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
            require_once __DIR__ . '/../views/postit_list.view.php';
            break;

        case 'update':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $postit = get_postit_details($id);
                if ($postit) {
                    require_once __DIR__ . '/../views/update.view.php';
                } else {
                    echo "Post-it non trouvé";
                }
            } else {
                echo "ID du post-it manquant";
            }
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

        case 'delete':
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $result = delete_postit($id);
                if ($result === true) {
                    header('Location: ?action=list');
                    exit();
                } else {
                    echo $result;
                }
            } else {
                echo "ID du post-it manquant";
            }
            break;

        default:
            echo "Page non trouvée.";
    }
}
?>