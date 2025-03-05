<?php
if (!isset($_SESSION)) {
    session_start();
}
require_once __DIR__ . '/../models/postit.model.php';
// Pour la partie création de postit
/**
 * On gère les différents endpoints/ on a utilisé les actionscomme endpoints,
 * Dans chaque action on fait appel à unevue qui correspond au endpoint
 * De base, ob devait mettre les appels aux vues dans controller.php mais pour nous facilliter
 * la tache, on a mis les appels aux vues dans les actions qui sont juste suivies
 * de l'action qui faitl'action pour la manipulation de la base
 */
function handle_request() {
    $action = isset($_GET['action']) ? $_GET['action'] : 'home';
    switch ($action) {
        /**
         * Lorsque l'on appuie sur le botton de création de postit, 
         * on a create comme endpoint qui fait appel à la vue creation.view.php
         */
        case 'create':
            require_once __DIR__ . '/../views/creation.view.php';
            break;

        /**
         * Une fois que l'on a rempli les champs dans la vue creation.view.php
         * on a create_postit comme endpoint qui fait appel a la methode create_postit dans 
         * le modele postit.model.php
         */
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

        /**
         * Pour la modification, on a comme endpoint update qui fait appel a la vue update.view.php
         * On recupere l'id du postit à modifier et on le psse en parametre dans get_postit_details
         * pour recuperer les details du postit et de pré-remplir les champs de la vue update.view.php
         */
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
        
        /**
         * Une fois que l'on est dans la vue de modifcation, on a la fonction update_postit qui est aussi dans postit.model.php
         * qui permet de mettre à jour les champs du postit
         */
        case 'update_postit':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['content'])) {
                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $content = $_POST['content'];           
                    $sharedUsers = isset($_POST['utilisateurs_partages']) ? json_decode($_POST['utilisateurs_partages'], true) : [];
                    $removedUsers = isset($_POST['utilisateurs_supprimes']) ? json_decode($_POST['utilisateurs_supprimes'], true) : [];
                    $result = update_postit($id, $title, $content);
                    if ($result === true) {
                        // Supprimer les utilisateurs partagés retirés
                        if (!empty($removedUsers)) {
                            $result_delete_faits = delete_shared_users($id, $removedUsers);
                        }
                        // Ajouter les nouveaux utilisateurs partagés
                        if(!empty($sharedUsers)){
                            $idUser = get_user_id_from_postit($id);
                            $result_insert_faits = insert_shared_users($id, $idUser, $sharedUsers);
                        }
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

        /**
         * Le principe est le meme pour delete, on a passé en parametre l'id du postit selectionné 
         * depuis la vue postit_list.view.php et on le passe en prametre dans la fonction afin de dynamiser la suppression
         */
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