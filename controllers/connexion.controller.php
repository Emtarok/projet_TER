<?php
// Inclure le modèle pour accéder aux données
require_once __DIR__ . '/../models/connexion.model.php';

function handle_connexion_request() {
    $action = isset($_GET['action']) ? $_GET['action'] : 'home';
    switch ($action) {
        case 'connexion':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if(isset($_POST['email']) && isset($_POST['password'])){
            
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    //recuperer a travers get_data() les données de la base de données
                    $user = get_data($email);
                    if ($user !== null) {
                        //vérification du mot de passe
                        session_start();
                            $_SESSION['user_id'] = $user['idutilisateur'];
                            $_SESSION['email'] = $user['email'];
                            $_SESSION['pseudo'] = $user['pseudo'];
                            //envoyer l'utilisateur à la page postit_list
                            header('Location: index.php?action=list');
                            exit();
                        /*
                        if (password_verify($password, $user['motdepasse'])) {
                            session_start();
                            $_SESSION['user_id'] = $user['idutilisateur'];
                            $_SESSION['email'] = $user['email'];
                            $_SESSION['pseudo'] = $user['pseudo'];
                            //envoyer l'utilisateur à la page postit_list
                            header('Location: index.php?action=list');
                            exit();
                        }else{
                            // echo "Mot de passe incorrect";
                        }*/
                    }else{
                        // echo "Email incorrect";
                        require_once __DIR__ . '/../views/connexion.view.php';
                    }
                }else{
                    // echo "Veuillez remplir tous les champs";
                }
            }else{
                require_once __DIR__ . '/../views/connexion.view.php';
            }
            break; 

        case "deconnexion":
            session_start();
            session_destroy();
            require_once __DIR__ . '/../views/connexion.view.php';
            break;

        default:
            require_once __DIR__ . '/../controllers/controller.php';
            break;
    }
}
?>
